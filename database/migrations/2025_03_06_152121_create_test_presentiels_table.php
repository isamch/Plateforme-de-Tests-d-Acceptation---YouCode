<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestPresentielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_presentiels', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('candidat_id');

            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('candidat_id')->references('id')->on('candidats')->onDelete('cascade');

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
        Schema::dropIfExists('test_presentiels');
    }
}
