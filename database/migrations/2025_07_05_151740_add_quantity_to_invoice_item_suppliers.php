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
        Schema::table('invoice_item_suppliers', function (Blueprint $table) {
            $table->decimal('supplier_quantity', 10, 2)->nullable()->after('supplier_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_item_suppliers', function (Blueprint $table) {
            $table->dropColumn('supplier_quantity');
        });
    }
};
