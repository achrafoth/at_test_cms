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
        Schema::table('provisions', function (Blueprint $table) {
            $table->decimal('cost', 10, 2)->default(0)->after('provision_date');
            $table->foreignId('at_equipment_item_id')->nullable()->after('at_equipment_id')
                  ->constrained('at_equipment_items')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provisions', function (Blueprint $table) {
            $table->dropForeign(['at_equipment_item_id']);
            $table->dropColumn(['cost', 'at_equipment_item_id']);
        });
    }
};
