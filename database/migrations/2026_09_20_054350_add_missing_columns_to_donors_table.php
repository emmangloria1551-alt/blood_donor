<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('donors', 'date_of_birth')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->date('date_of_birth')->nullable();
            });
        }

        if (!Schema::hasColumn('donors', 'phone')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->string('phone')->nullable();
            });
        }

        if (!Schema::hasColumn('donors', 'address')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->string('address')->nullable();
            });
        }

        if (!Schema::hasColumn('donors', 'is_active')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('donors', 'is_active')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }

        if (Schema::hasColumn('donors', 'address')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->dropColumn('address');
            });
        }

        if (Schema::hasColumn('donors', 'phone')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->dropColumn('phone');
            });
        }

        if (Schema::hasColumn('donors', 'date_of_birth')) {
            Schema::table('donors', function (Blueprint $table) {
                $table->dropColumn('date_of_birth');
            });
        }
    }
};