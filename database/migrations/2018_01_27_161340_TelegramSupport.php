<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TelegramSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('telegram_users', function (Blueprint $table) {
		    $table->increments('id')->unsigned();
		    $table->integer('chat_id');
		    $table->string('username');
	    });

	    Schema::table('statuses', function (Blueprint $table) {
		    $table->boolean('telegram_off_notified');
		    $table->boolean('telegram_on_notified');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('telegram_users');

	    Schema::table('statuses', function (Blueprint $table) {
		    $table->dropColumn('telegram_off_notified');
		    $table->dropColumn('telegram_on_notified');
	    });
    }
}
