<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_centers', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('location');

            $table->string('contact_number')->nullable();

            $table->string('opening_time')->nullable();

            $table->string('closing_time')->nullable();

            $table->string('status')->default('open');

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_centers');
    }
};