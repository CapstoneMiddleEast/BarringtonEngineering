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
           
            $table->string('lpo_received_file')->nullable()->after('lpo_received_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_enquiries', function (Blueprint $table) {
            $table->dropColumn('lpo_received_file');
        });
    }
};
