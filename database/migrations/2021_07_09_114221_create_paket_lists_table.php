<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->unsignedBigInteger('pelajaran_id')->nullable();
            $table->timestamps();
        });

        Schema::table('paket_pelajaran', function($table){
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pelajaran_id')->references('id')->on('pelajarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_pelajaran');
    }
}
