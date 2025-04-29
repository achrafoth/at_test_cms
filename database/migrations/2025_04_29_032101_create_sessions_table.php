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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('trusted_specialist_id')->constrained('trusted_specialists')->onDelete('cascade');
            $table->foreignId('at_expert_id')->nullable()->constrained('a_t_experts')->onDelete('set null');
            $table->enum('session_type', ['Assessment', 'Training', 'Device Setup', 'Follow-up']);
            $table->dateTime('session_date');
            $table->integer('session_duration')->comment('Duration in minutes');
            $table->text('notes')->nullable();
            $table->text('outcome')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
