<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("building_id")->nullable();
            $table->string("member_id")->nullable();
            $table->string("number_room")->nullable();
            $table->double("mitor_cable")->nullable();
            $table->double("mitor_wifi")->nullable();
            $table->string("status")->nullable();
            $table->double("rent")->nullable();
            $table->double("deposit")->nullable();
            $table->string("transaction_log")->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
