<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->text('alamat');
            $table->string('nama_lengkap');
            $table->bigInteger('no_hp');
            $table->enum('gender', ['Wanita','Pria']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('mengajar');
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
        Schema::dropIfExists('gurus');
    }
}
