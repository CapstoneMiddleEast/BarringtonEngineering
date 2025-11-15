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
        Schema::create('companies', function (Blueprint $table) {
            $table->id('company_id'); // Auto-increment PK

            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();

            $table->string('cmp_trn_no', 100)->nullable();
            $table->string('cmp_licence_no', 100)->nullable();
            $table->string('cmp_contact_person', 100)->nullable();
            $table->string('cmp_contact_no', 100)->nullable();
            $table->string('cmp_logo', 255)->nullable();
            $table->string('cmp_doc', 255)->nullable();
            $table->string('cmp_address1', 200)->nullable();
            $table->string('cmp_address2', 200)->nullable();

            // Flags
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);

            // Audit fields
            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamp('modified_at')->nullable();
            $table->unsignedBigInteger('modified_by')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('modified_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
