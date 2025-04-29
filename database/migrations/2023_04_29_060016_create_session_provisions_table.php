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
        Schema::create('session_provisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_session_id')->constrained()->onDelete('cascade');
            $table->foreignId('provision_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('software_provision_id')->nullable()->constrained('software_provisions')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_provisions');
    }
};
