<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('disability_type')->nullable();
            $table->string('nationality')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('assigned_trusted_specialist_id')->nullable();
            $table->foreignId('assigned_at_expert_id')->nullable();
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
