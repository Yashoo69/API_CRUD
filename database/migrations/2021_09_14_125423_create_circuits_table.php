<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->id('circuitId');
            $table->string('circuitRef');
            $table->integer('name');
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->integer('alt')->nullable();
            $table->string('url')->unique();
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
        Schema::dropIfExists('circuits');
    }
}
