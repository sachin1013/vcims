<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('user_type')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('family_code')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('notes')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->integer('age')->nullable();
            $table->string('family_group_code')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('city_id')->nullable();
            $table->tinyInteger('state_id')->nullable();
            $table->tinyInteger('country_id')->nullable();
            $table->string('reference_by')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
