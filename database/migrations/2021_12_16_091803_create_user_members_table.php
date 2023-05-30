<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_members', function (Blueprint $table) {
            $table->id();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("phone")->nullable();
            $table->string("citizen")->nullable();
            $table->string("line")->nullable();
            $table->string("facebook")->nullable();
            $table->string("email")->nullable();
            $table->string("image")->nullable();
            $table->string("password")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->string("emergency_name")->nullable();
            $table->string("relationship")->nullable();
            $table->string("phone_relationship")->nullable();
            $table->string("description")->nullable();
            $table->string("status")->nullable();
            $table->date("day_in")->nullable();
            $table->date("day_out")->nullable();
            $table->double("amount_people")->nullable();
            $table->string("period")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user_members');
    }
}
