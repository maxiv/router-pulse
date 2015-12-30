<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Statuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('ip');
            $table->boolean('isp1');
            $table->boolean('isp2');
            $table->dateTime('session_started');
            $table->dateTime('session_ended');

            $table->index('isp1');
            $table->index('isp2');
            $table->index('session_started');
            $table->index('session_ended');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statuses');
    }
}
