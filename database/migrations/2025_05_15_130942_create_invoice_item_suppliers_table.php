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
        Schema::create('invoice_item_suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('invoice_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->string('supplier_invoice')->nullable();
            $table->decimal('supplier_unit_price', 10, 2)->nullable();
            $table->decimal('supplier_total_price', 10, 2)->nullable();
            $table->decimal('supplier_vat', 10, 2)->nullable();
            $table->decimal('supplier_total_price_vat', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_item_suppliers');
    }
};
