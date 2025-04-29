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
        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('at_equipment_id')->nullable()->constrained('a_t_equipment')->onDelete('set null');
            $table->foreignId('at_software_id')->nullable()->constrained('a_t_software')->onDelete('set null');
            $table->decimal('approximate_value', 10, 2)->default(0);
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->foreignId('requested_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_items');
    }
};
