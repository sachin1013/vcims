<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('invoice_date')->nullable();
            $table->string('sales_invoice_no');
            $table->integer('category_id');
            $table->string('barcode');
            $table->integer('product_name');
            $table->integer('unit_price');
            $table->integer('sell_qty');
            $table->integer('cgst_perc')->nullable();
            $table->double('cgst_amt', 8, 2)->nullable();
            $table->integer('sgst_perc')->nullable();
            $table->double('sgst_amt', 8, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->double('discount_rate', 8, 2)->nullable();
            $table->integer('discount_amt')->nullable();
            $table->integer('sub_total');
            $table->integer('total_product');
            $table->date('du_date')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('invoice_details');
    }
}
