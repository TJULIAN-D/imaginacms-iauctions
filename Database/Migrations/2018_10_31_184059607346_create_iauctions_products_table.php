<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIauctionsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iauctions__products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('slug');
            $table->integer('unity')->default(0)->unsigned();
            $table->double('concentration', 8, 2)->default(0);
            $table->double('dosis_ha', 8, 2)->default(0);
           
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('iauctions__categories')->onDelete('restrict');
            
            $table->integer('ingredient_id')->unsigned()->nullable();
            $table->foreign('ingredient_id')->references('id')->on('iauctions__ingredients')->onDelete('restrict');
            
            $table->integer('status')->default(1)->unsigned();

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
        Schema::dropIfExists('iauctions__products');
    }
}
