<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntensifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intensifs', function (Blueprint $table) {
            $table->id();
            $table->longText('deskripsi');
            $table->string('nama');
            $table->bigInteger('harga');
            $table->integer('kelas');
            $table->enum('jenjang', ['SD','SMP','SMA']);
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
        Schema::dropIfExists('intensifs');
    }
}
