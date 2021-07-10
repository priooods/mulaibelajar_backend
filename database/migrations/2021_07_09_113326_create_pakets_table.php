<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kls');
            $table->string('nme');
            $table->longText('dsc');
            $table->string('cde');
            $table->enum('jrs', ['IPA','IPS']);
            $table->bigInteger('prc');
            $table->enum('pplr',['Popular','Not Popular'])->default('Not Popular');
            $table->string('img')->nullable();
            $table->timestamps();
        });
        Schema::table('pakets', function($table){
            $table->foreign('kls')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakets');
    }
}
