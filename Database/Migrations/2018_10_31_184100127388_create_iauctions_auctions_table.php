<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__auctions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->string('title');
            $table->text('description');

            $table->double('base_price', 30, 2)->default(0);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->integer('quantity')->default(0)->unsigned();
            $table->integer('area')->default(0)->unsigned();
            $table->integer('longer_term')->default(0)->unsigned();
            $table->integer('financial_cost_daily')->default(0)->unsigned();
            $table->integer('financial_cost_monthly')->default(0)->unsigned();
            $table->integer('longer_term_freight')->default(0)->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('ingredient_id')->unsigned()->nullable();
            $table->integer('status')->default(1)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
            $table->integer('winner_id')->nullable();
            $table->double('winner_value')->nullable();
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
        Schema::dropIfExists('iauctions__auctions');
    }
}
