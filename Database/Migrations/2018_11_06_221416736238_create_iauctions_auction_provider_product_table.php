<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsAuctionProviderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__auction_provider_product', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->integer('auction_provider_id')->unsigned();
            $table->foreign('auction_provider_id')->references('id')->on('iauctions__auction_provider')->onDelete('restrict');
            $table->integer('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('iauctions__products')->onDelete('restrict');
            
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
        Schema::dropIfExists('iauctions__auction_provider_product');
    }
}
