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
        Schema::table('sales_enquiries', function (Blueprint $table) {
            $table->dropColumn('item_code');
            $table->dropColumn('materials_description');
            $table->dropColumn('buying_price');
            $table->dropColumn('selling_price');
            $table->string('quotation_no')->nullable()->change();
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_enquiries', function (Blueprint $table) {
            $table->string('item_code')->nullable();
            $table->text('materials_description');
            $table->decimal('buying_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->string('quotation_no')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
        });
    }
};
