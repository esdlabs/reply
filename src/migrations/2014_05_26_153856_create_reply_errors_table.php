<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyErrorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_errors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('error_code')->unique();
            $table->integer('response_code');
            $table->string('description');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reply_errors');
    }

}
