<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrectRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correct_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isConversion')->default('no');

            $table->integer('uid_id')->unsigned();
            $table->foreign('uid_id')
                ->references('id')->on('uids')
                ->onDelete('cascade');

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')->on('clients')
                ->onDelete('cascade');

            $table->integer('device_id')->unsigned()->nullable();
            $table->foreign('device_id')
                ->references('id')->on('devices')
                ->onDelete('cascade');

            $table->string('ip')->nullable();

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
        Schema::dropIfExists('correct_requests');
    }
}
