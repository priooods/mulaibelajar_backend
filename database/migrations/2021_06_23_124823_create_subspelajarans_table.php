<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubspelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subspelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plj_id');
            $table->unsignedBigInteger('kls_id')->nullable();
            $table->string('img')->nullable();
            $table->string('title');
            $table->longText('subs');
            $table->enum('level',['Junior','Intermediet','Advance'])->nullable();
            $table->timestamps();
        });

        Schema::table('subspelajarans', function($table){
            $table->foreign('plj_id')->references('id')->on('pelajarans')->onDelete('cascade');
            $table->foreign('kls_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subspelajarans');
    }
}
