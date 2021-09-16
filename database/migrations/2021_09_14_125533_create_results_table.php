<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id('resultId');

            $table->integer('raceId'); 
            $table->foreign('raceId')->references('raceId')->on('races');

            $table->integer('driverId'); 
            $table->foreign('driverId')->references('driverId')->on('drivers');

            $table->integer('constructorId');
            $table->foreign('constructorId')->references('constructorId')->on('constructors');

            $table->string('positiontext');
            $table->integer('positionOrder')->default(0);
            $table->integer('grid')->default(0);
            $table->integer('laps')->default(0);
            $table->float('points')->default(0);

            $table->string('time')->nullable();
            $table->integer('number')->nullable();
            $table->integer('position')->nullable();
            $table->integer('milliseconds')->nullable();
            $table->integer('fastestLap')->nullable();
            $table->integer('rank')->nullable()->default(0);
            $table->string('fastestLapTime')->nullable();
            $table->string('fastestLapSpeed')->nullable();
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
        Schema::dropIfExists('results');
    }
}
