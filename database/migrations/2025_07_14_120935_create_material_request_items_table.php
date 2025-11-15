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
        Schema::create('material_request_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('material_request_id')->constrained()->onDelete('cascade');
            $table->string('material_name');
            $table->text('material_description')->nullable();
            $table->integer('quantity');
            $table->date('date_needed');
            $table->text('scope_of_work')->nullable();
            $table->string('project_location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_request_items');
    }
};
