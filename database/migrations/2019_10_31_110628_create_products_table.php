<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('producer_id');
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade');
            $table->string('name');
            $table->string('image');
            $table->string('sku_code');
            $table->string('productivity')->default('Đang cập nhật...');
            $table->string('vol')->default('Đang cập nhật...');
            $table->string('wat')->default('Đang cập nhật...');
            $table->string('bearings')->default('Đang cập nhật...');
            $table->string('speed')->default('Đang cập nhật...');
            $table->string('weight')->default('Đang cập nhật...');
            $table->string('size')->default('Đang cập nhật...');
            $table->string('model')->default('Đang cập nhật...');
            $table->string('insurance')->default('Đang cập nhật...');
            $table->longText('information_details')->nullable();
            $table->longText('product_introduction')->nullable();
            $table->float('rate', 2, 1)->default(5);
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
