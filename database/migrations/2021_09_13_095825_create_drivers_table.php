<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id('driverId');
            $table->string('driverRef');
            $table->integer('number')->nullable();
            $table->string('code')->nullable();
            $table->string('forename');
            $table->string('surname');
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
