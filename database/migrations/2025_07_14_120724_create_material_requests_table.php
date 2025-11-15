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
        Schema::create('material_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('project')->nullable();
            $table->text('purpose_of_use')->nullable();
            $table->foreignId('requested_by')->constrained('users');
            $table->date('requested_date');
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->date('reviewed_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->date('approved_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_requests');
    }
};
