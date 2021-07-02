<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umum_id')->nullable();
            $table->string('title');
            $table->string('code');
            $table->longText('subs');
            $table->string('img')->nullable();
            $table->timestamps();
        });
        Schema::table('pelajarans', function($table){
            $table->foreign('umum_id')->references('id')->on('pel_umums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelajarans');
    }
}
