<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id('raceId');
            $table->integer('year')->default(0);
            $table->integer('round')->default(0);

            $table->integer('circuitId'); 
            $table->foreign('circuitId')->references('circuitId')->on('circuits');

            $table->string('name');
            $table->date('date')->default("0000-00-00");
            $table->time('time')->nullable();
            $table->string('url')->nullable()->unique();
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
        Schema::dropIfExists('races');
    }
}
