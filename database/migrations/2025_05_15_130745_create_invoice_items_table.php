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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained('item_codes')->onDelete('cascade');
            $table->string('unit')->nullable();
            $table->string('do_no')->nullable();
            $table->string('ticket_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('delivery_point')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->decimal('client_unit_price', 10, 2)->nullable();
            $table->decimal('client_total_price', 10, 2)->nullable();
            $table->decimal('client_vat', 10, 2)->nullable();
            $table->decimal('client_total_price_vat', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
