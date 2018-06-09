<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('court_images', function (Blueprint $table) {            
            $table->increments('id');
            $table->integer('court_id');
            $table->foreign('court_id')->references('id')->on('courts')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('court_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('court_images');
    }
}
