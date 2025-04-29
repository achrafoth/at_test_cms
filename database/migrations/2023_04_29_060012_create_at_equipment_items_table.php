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
        Schema::create('at_equipment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('at_equipment_id')->constrained('a_t_equipment')->onDelete('cascade');
            $table->string('serial_number')->nullable();
            $table->decimal('purchase_value', 10, 2)->default(0);
            $table->enum('status', ['available', 'loan', 'provision', 'procured'])->default('available');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('at_equipment_items');
    }
};
