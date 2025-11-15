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
        Schema::create('sales_enquiry_item_code', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_enquiry_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_code_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 8, 2)->nullable();
            $table->string('unit')->nullable();
            $table->decimal('buying_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_enquiry_item_code');
    }
};
