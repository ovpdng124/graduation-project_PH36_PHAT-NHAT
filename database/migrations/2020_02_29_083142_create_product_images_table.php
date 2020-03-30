<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_path');
            $table->integer('image_type');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_attribute_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
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
        Schema::dropIfExists('product_images');
    }
}
