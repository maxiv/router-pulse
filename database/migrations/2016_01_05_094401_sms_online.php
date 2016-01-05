<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SmsOnline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->renameColumn('sms_notified', 'sms_off_notified');
            $table->boolean('sms_on_notified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->renameColumn('sms_off_notified', 'sms_notified');
            $table->dropColumn('sms_on_notified');
        });
    }
}
