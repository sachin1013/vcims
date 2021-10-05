<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sales_invoice_no')->nullable();
            $table->date('sales_invoice_date')->nullable();
            $table->integer('customer_id');
            $table->integer('prescription_id')->nullable();
            $table->string('prescription_status')->nullable();
            $table->string('tax_status')->nullable();
            $table->string('taxation_type')->nullable();
            $table->double('cgst_total', 8, 2)->nullable();
            $table->double('sgst_total', 8, 2)->nullable();
            $table->integer('discount_total')->nullable();
            $table->integer('total_qty')->nullable();
            $table->unsignedBigInteger('grand_total');
            $table->date('due_date')->nullable();
            $table->string('delivery_type')->nullable();
            $table->integer('address_id')->nullable();
            $table->longText('notes')->nullable();
            $table->tinyInteger('sales_invoice_status')->default('0');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
