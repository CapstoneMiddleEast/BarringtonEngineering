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
        Schema::create('sales_enquiries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('inquiry_date_received');
            $table->string('item_code');
            $table->unsignedBigInteger('author_id'); // Foreign key for the author
            $table->unsignedBigInteger('assigned_sales_person_id')->nullable(); // Foreign key for the assigned sales person
            $table->string('client_name');
            $table->string('delivery_point');
            $table->text('materials_description');
            $table->date('date_sent_quotation_to_client')->nullable();
            $table->date('date_follow_up_to_client')->nullable();
            $table->string('quotation_status');
            $table->enum('lpo_received', ['YES', 'NO']);
            $table->integer('no_of_days_taken_for_preparing_quotation')->nullable();
            $table->text('remark')->nullable();
            $table->string('contact_person');
            $table->string('contact_no');
            $table->string('email');
            $table->decimal('buying_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->string('quotation_no');
            $table->text('follow_up')->nullable();
            $table->text('lpo_received_text')->nullable();
            // Foreign keys
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_sales_person_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_enquiries');
    }
};
