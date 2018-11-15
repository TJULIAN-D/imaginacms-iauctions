<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsAuctionProviderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__auctionproviderproducts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->integer('auctionprovider_id')->unsigned();
            $table->foreign('auctionprovider_id')->references('id')->on('iauctions__auctionproviders')->onDelete('restrict');
            
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
        Schema::dropIfExists('iauctions__auctionproviderproducts');
    }
}
