<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_rooms', function (Blueprint $table) {
            $table->id();
            $table->string("room_id")->nullable();
            $table->double("mitor_water")->nullable();
            $table->double("mitor_electric")->nullable();
            $table->double("summary_water")->nullable();
            $table->double("summary_electric")->nullable();
            $table->double("amount_water")->nullable();
            $table->double("amount_electric")->nullable();
            $table->double("summary")->nullable();
            $table->double("qrcode")->nullable();
            $table->double("bank")->nullable();
            $table->date("date_bill")->nullable();
            $table->string("status")->nullable();
            $table->string("other")->nullable();
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
        Schema::dropIfExists('bill_rooms');
    }
}
