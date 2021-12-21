<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('surname');
            $table->date('borndate', 'dd/mm/YY');
            $table->integer('phonenum');
            $table->string('cf');
            $table->string('city');
            $table->string('adress');
            $table->string('sint1');
            $table->string('sint2');
            $table->string('sint3');
            $table->string('sint4');
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
        Schema::dropIfExists('patients');
    }
}
