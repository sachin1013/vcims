<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     *tax_status : Applicable / Not applicable
     *
     *taxation_type : Inclusive of amount / Exclusive of amount
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('purchase_date');
            $table->string('purchase_invoice_no');
            $table->integer('vendor_id');
            $table->string('tax_status')->nullable(); 
            $table->string('taxation_type')->nullable();
            $table->integer('total_discount');
            $table->double('cgst_total', 8, 2)->nullable();
            $table->double('sgst_total', 8, 2)->nullable();            
            $table->integer('total_qty')->nullable();
            $table->unsignedBigInteger('grand_total');
            $table->longText('description')->nullable();
            $table->longText('status')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
