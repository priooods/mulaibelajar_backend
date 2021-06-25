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
            $table->integer('pertemuan');
            $table->dateTime('waktu');
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->unsignedBigInteger('manage_kelas_id')->nullable();
            $table->timestamps();
        });

        Schema::table('silabuses', function($table){
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('set null');
            $table->foreign('manage_kelas_id')->references('id')->on('manage_kelas')->onDelete('set null');
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
