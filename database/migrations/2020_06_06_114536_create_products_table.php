<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vendor_id');
            $table->integer('category_id');
            $table->string('product_model_no')->nullable();
            $table->string('product_collection')->nullable();
            $table->string('country_origin')->nullable();
            $table->string('brand')->nullable();
            $table->string('frame_type')->nullable();
            $table->string('frame_shape')->nullable();
            $table->string('frame_size')->nullable();
            $table->string('frame_dimension')->nullable();
            $table->integer('temple_length')->nullable();
            $table->integer('bridge_width')->nullable();
            $table->integer('lens_width')->nullable();
            $table->string('sunglass_color')->nullable();
            $table->string('sunglass_lens_material')->nullable();
            $table->string('sunglass_lens_technology')->nullable();
            $table->string('frame_color')->nullable();
            $table->string('temple_color')->nullable();
            $table->string('frame_weight')->nullable();
            $table->string('frame_material')->nullable();
            $table->string('temple_material')->nullable();
            $table->string('prescription_type')->nullable();
            $table->string('frame_style')->nullable();
            $table->string('frame_style_secondary')->nullable();
            $table->string('gender')->nullable();
            $table->string('product_condition')->nullable();
            $table->string('product_warranty')->nullable();
            $table->string('contact_lens_type')->nullable();
            $table->double('base_curve', 8, 4)->nullable();
            $table->string('contact_lens_color')->nullable();
            $table->double('contact_lens_diameter', 8, 4)->nullable();
            $table->double('water_content', 8, 4)->nullable();
            $table->string('contact_lens_material')->nullable();
            $table->string('contact_lens_packaging')->nullable();
            $table->string('usage_duration')->nullable();
            $table->integer('contact_lens_solution_qty')->nullable();
            $table->double('quantity')->default('0');
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('products');
    }
}
