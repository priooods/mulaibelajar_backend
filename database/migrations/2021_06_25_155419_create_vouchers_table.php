<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode');
            $table->bigInteger('potongan');
            $table->date('mulai');
            $table->date('selesai');
            $table->enum('paket', ['parsial','intensif','semaumu']);
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->timestamps();
        });

        Schema::table('vouchers', function($table){
            $table->foreign('paket_id')->references('id')->on('paket_pelajarans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
