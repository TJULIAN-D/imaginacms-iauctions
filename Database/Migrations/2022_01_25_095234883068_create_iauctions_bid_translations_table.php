<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsBidTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__bid_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('bid_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['bid_id', 'locale']);
            $table->foreign('bid_id')->references('id')->on('iauctions__bids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iauctions__bid_translations', function (Blueprint $table) {
            $table->dropForeign(['bid_id']);
        });
        Schema::dropIfExists('iauctions__bid_translations');
    }
}
