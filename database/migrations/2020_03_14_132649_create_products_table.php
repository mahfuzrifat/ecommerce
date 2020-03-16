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
            $table->unsignedBigInteger('category_id');
            $table->integer('subcategory_id');
            $table->integer('brand_id');
            $table->string('product_name')->unique(); 
            $table->string('slug');
            $table->string('product_code')->unique();
            $table->string('product_color');
            $table->string('product_size')->nullable();
            $table->integer('qty');
            $table->boolean('new_arrival')->nullable();
            $table->boolean('best_deals')->nullable();
            $table->boolean('best_seller')->nullable();
            $table->boolean('featured_items')->nullable(); 
            $table->boolean('buyone_getone')->nullable(); 
            $table->string('buy_price');
            $table->string('sell_price'); 
            $table->string('video_link')->nullable(); 
            $table->integer('discount_price')->nullable(); 
            $table->string('photo_one')->default('default1.pnj');
            $table->string('photo_two')->default('default2.pnj');
            $table->string('photo_three')->default('default3.pnj');
            $table->text('product_details')->nullable();
            $table->boolean('product_status')->default(true);
            $table->foreign('category_id')->references('id')
                  ->on('categories')->onDelete('cascade');
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
