<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->longText('deskripsi');
            $table->enum('jurusan', ['IPA','IPS']);
            $table->bigInteger('harga');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();
        });

        Schema::table('paket_pelajarans', function (Blueprint $table) {
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
        Schema::dropIfExists('paket_pelajarans');
    }
}
