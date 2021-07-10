<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('cde');
            $table->string('titl');
            $table->string('nick');
            $table->text('desc');
            $table->enum('type',['ngoding','nulis','akademik']);
            $table->enum('pplr',['Popular','Not Popular'])->default('Not Popular');
            $table->string('img')->nullable();
            $table->enum('lvl',['Junior','Intermediet','Advance'])->default('Junior');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();
        });

        Schema::table('pelajarans', function($table){
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelajarans');
    }
}
