<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['LUNAS','PROSES','BELUM'])->default('BELUM');
            $table->unsignedBigInteger('user_id');
            // $table->datetime('expired');
            $table->datetime('waktu_lunas')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->timestamps();
        });

        Schema::table('pembayarans', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
