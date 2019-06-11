<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__bids', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->integer('auction_id')->unsigned();
            $table->foreign('auction_id')->references('id')->on('iauctions__auctions')->onDelete('restrict');
            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->string('code_user')->nullable();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('iauctions__products')->onDelete('restrict');
            $table->double('price', 30, 2)->default(0);
            $table->integer('longer_term')->default(0)->unsigned();
            $table->float('tax', 8, 2)->default(0);
            $table->integer('freight_term')->default(0)->unsigned();
            $table->double('freight_price', 30, 2)->default(0);
            $table->text('options')->default('')->nullable();
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
        Schema::dropIfExists('iauctions__bids');
    }
}
