<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsAuctionProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__auction_provider', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->integer('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('iauctions__auctions')->onDelete('restrict');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->integer('status')->default(0)->unsigned();
            $table->string('code_user')->nullable();
            
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
