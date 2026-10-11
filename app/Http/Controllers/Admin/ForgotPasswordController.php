<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
        ]);

        $email = strtolower(trim($request->email));

        // Make sure the email belongs to an administrator
        $admin = User::where('email', $email)
            ->where('role', 'admin')
            ->where('status', 'active')
            ->first();

        if (!$admin) {
            return back()
                ->withErrors([
                    'email' => 'No active administrator account was found with this email address.',
                ])
                ->withInput();
        }

        $status = Password::broker()->sendResetLink([
            'email' => $email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(
                'success',
                'Password reset link sent successfully. Check your email.'
            );
        }

        return back()
            ->withErrors([
                'email' => __($status),
            ])
            ->withInput();
    }

    /**
     * Show password reset form
     */
    public function showResetForm(Request $request, $token)
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset administrator password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $status = Password::broker()->reset(
            [
                'email' => strtolower(trim($request->email)),
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('admin.login')
                ->with(
                    'success',
                    'Your administrator password has been reset successfully. You can now log in.'
                );
        }

        return back()
            ->withErrors([
                'email' => __($status),
            ])
            ->withInput();
    }
}