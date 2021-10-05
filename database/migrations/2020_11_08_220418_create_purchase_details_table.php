<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('invoice_no');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->string('hsn_sac');
            $table->integer('unit_price');
            $table->integer('buying_qty');
            $table->integer('cgst_perc')->nullable();
            $table->double('cgst_amt', 8, 2)->nullable();
            $table->integer('sgst_perc')->nullable();
            $table->double('sgst_amt', 8, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->double('discount_rate', 8, 2)->nullable();
            $table->integer('discount_amt')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('sub_total');
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('purchase_details');
    }
}
