<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->text('almt');
            $table->string('flnm');
            $table->bigInteger('nhp');
            $table->enum('gndr', ['Wanita','Pria']);
            $table->date('tglhr'); //tgl lahir
            $table->string('tmlhr'); //tmpt lahir
            $table->string('mgjr'); //mengajar di mana
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
        Schema::dropIfExists('gurus');
    }
}
