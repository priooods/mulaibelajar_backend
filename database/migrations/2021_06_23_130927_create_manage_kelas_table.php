<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plj_id')->nullable();
            $table->bigInteger('harga_akhir');
            $table->bigInteger('harga_discount')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->timestamps();
        });

        Schema::table('manage_kelas', function($table){
            $table->foreign('plj_id')->references('id')->on('subspelajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_kelas');
    }
}
