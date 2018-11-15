<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsAuctionProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__auctionproviders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->integer('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('iauctions__auctions')->onDelete('restrict');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');

            $table->integer('status')->default(0)->unsigned();
            
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
        Schema::dropIfExists('iauctions__auctionproviders');
    }
}
