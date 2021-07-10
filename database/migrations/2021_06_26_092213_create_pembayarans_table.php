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
            $table->unsignedBigInteger('user_id');
            $table->string('cde_kls');
            $table->string('cde_afl')->nullable();
            $table->enum('sts',['Lunas','Proses','Belum Lunas'])->default('Belum Lunas');
            $table->datetime('wktln')->nullable(); //waktu lunas
            $table->string('bktf')->nullable(); //bukti tf
            $table->integer('prc'); //price end
            $table->timestamps();
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
