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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('customer_name')->after('date')->nullable();
            $table->text('customer_address')->after('customer_name')->nullable();
            $table->json('items')->after('customer_address')->nullable();
            
            // Make legacy fields nullable
            $table->foreignId('tradie_id')->nullable()->change();
            $table->text('work_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['customer_name', 'customer_address', 'items']);
            
            // Revert legacy fields (if needed, though making them nullable is safer)
            $table->foreignId('tradie_id')->nullable(false)->change();
            $table->text('work_description')->nullable(false)->change();
        });
    }
};
