<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengalamanGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengalaman_gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->integer('tahun_mulai');
            $table->integer('tahun_selesai');
            $table->string('sekolah');
            $table->string('pelajaran');
            $table->timestamps();
        });

        Schema::table('pengalaman_gurus', function($table){
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengalaman_gurus');
    }
}
