<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffStaffEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_staff_event', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('staff_event_id');

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('staff_event_id')->references('id')->on('staff_events')->onDelete('cascade');


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
        Schema::dropIfExists('staff_staff_events');
    }
}
