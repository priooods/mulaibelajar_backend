<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSilabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('silabuses', function (Blueprint $table) {
            $table->id();
            $table->integer('ptmn'); //pertemuan
            $table->unsignedBigInteger('pelajaran_id');
            $table->timestamps();
            $table->foreign('pelajaran_id')->references('id')->on('pelajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('silabuses');
    }
}
