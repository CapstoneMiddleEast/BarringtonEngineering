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
        Schema::table('material_request_items', function (Blueprint $table) {
            $table->string('unit')->nullable()->after('quantity');
            $table->boolean('rejected')->default(false)->after('project_location');
            $table->text('rejected_reason')->nullable()->after('rejected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_request_items', function (Blueprint $table) {
            $table->dropColumn(['unit', 'rejected', 'rejected_reason']);
        });
    }
};
