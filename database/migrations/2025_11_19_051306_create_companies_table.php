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
            $table->id();
            $table->timestamps();
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('cmp_trnno', 100)->nullable();
            $table->string('cmp_contact_person', 100)->nullable();
            $table->string('cmp_license_no', 100)->nullable();
            $table->string('cmp_license_document', 100)->nullable(); // path
            $table->string('cmp_logo', 100)->nullable(); // logo path
            $table->string('cmp_contact_no', 100)->nullable();
            $table->string('cmp_address1', 200)->nullable();
            $table->string('cmp_address2', 200)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('deleted_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->boolean('is_deleted')->default(false);

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
