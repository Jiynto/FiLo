<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table)
         {
            $table->id();
            $table->enum('category', config('enums.itemCategory'))->default('other');
            $table->date('found_date');
            $table->time('found_time');
            $table->bigInteger('userid')->unsigned();
            $table->string('found_place', 256);
            $table->enum('color', config('enums.itemColor'))->nullable();
            $table->string('image', 256)->nullable();
            $table->string('description', 256)->nullable();
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
