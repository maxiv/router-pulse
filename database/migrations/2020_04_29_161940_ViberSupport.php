<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViberSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viber_users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('viber_id');
            $table->string('name');
        });

        Schema::table('statuses', function (Blueprint $table) {
            $table->boolean('viber_off_notified');
            $table->boolean('viber_on_notified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('viber_users');

        Schema::table('statuses', function (Blueprint $table) {
            $table->dropColumn('viber_off_notified');
            $table->dropColumn('viber_on_notified');
        });
    }
}
