<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_pakets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_pelajaran_id');
            $table->unsignedBigInteger('manage_kelas_id');
            $table->timestamps();
        });

        Schema::table('manage_pakets', function($table){
            $table->foreign('paket_pelajaran_id')->references('id')->on('paket_pelajarans')->onDelete('cascade');
            $table->foreign('manage_kelas_id')->references('id')->on('manage_kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_pakets');
    }
}
