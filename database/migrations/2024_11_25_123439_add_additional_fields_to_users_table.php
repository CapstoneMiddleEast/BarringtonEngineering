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
        Schema::table('users', function (Blueprint $table) {
            $table->text('about')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('address')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->date('join_date')->nullable();
            $table->string('employee_id')->unique()->nullable();
            $table->string('availability_status')->default('active'); // active, leave, blocked.
            $table->string('languages_spoken')->nullable(); // JSON to store multiple languages
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'about',
                'phone_number',
                'whatsapp_number',
                'address',
                'job_title',
                'department',
                'join_date',
                'employee_id',
                'availability_status',
                'languages_spoken',
            ]);
        });
    }
};
