<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pembayaran_id');
            $table->bigInteger('harga');
            $table->enum('type', ['pilih','paket']);
            $table->enum('paket', ['parsial','intensif','semaumu','serius']);
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->timestamps();
        });

        Schema::table('pesanans', function($table){
            $table->foreign('paket_id')->references('id')->on('paket_pelajarans')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
