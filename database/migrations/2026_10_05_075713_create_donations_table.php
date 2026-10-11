<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donor_id')
                ->constrained('donors')
                ->cascadeOnDelete();

            $table->string('blood_type', 5);

            $table->integer('units')->default(1);

            $table->string('status')->default('pending');

            $table->dateTime('donated_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};