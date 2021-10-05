<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->string('patient_name');
            $table->string('left_eye_sph')->nullable();
            $table->string('left_eye_cyl')->nullable();
            $table->string('left_eye_axis')->nullable();
            $table->string('left_eye_add')->nullable();
            $table->string('left_eye_va_dist')->nullable();
            $table->string('left_eye_va_near')->nullable();
            $table->string('left_eye_pd')->nullable();
            $table->string('right_eye_sph')->nullable();
            $table->string('right_eye_cyl')->nullable();
            $table->string('right_eye_axis')->nullable();
            $table->string('right_eye_add')->nullable();
            $table->string('right_eye_va_dist')->nullable();
            $table->string('right_eye_va_near')->nullable();
            $table->string('right_eye_pd')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('prescription_condition')->nullable();
            $table->string('status')->default('1');
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
