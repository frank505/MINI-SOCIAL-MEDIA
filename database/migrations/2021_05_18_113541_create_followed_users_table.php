<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followed_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned();
            $table->bigInteger('followed_userid')->unsigned();
            $table->foreign('userid')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('followed_userid')->references('id')
                ->on('users');
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
        Schema::dropIfExists('followed_users');
    }
}
