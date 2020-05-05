<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemrequests', function (Blueprint $table)
        {
            $table->id();
            $table->bigInteger('itemid')->unsigned();
            $table->bigInteger('userid')->unsigned();
            $table->string('reason', 256);
            $table->enum('requeststate', config('enums.itemRequestStates'))->default('open');
            $table->timestamps();
            $table->foreign('itemid')->references('id')->on('items');
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
        Schema::dropIfExists('itemrequests');
    }
}
