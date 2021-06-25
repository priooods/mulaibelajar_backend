<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageIntensifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_intensifs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intensif_id');
            $table->unsignedBigInteger('manage_kelas_id')->nullable();
            $table->timestamps();
        });

        Schema::table('manage_intensifs', function($table){
            $table->foreign('intensif_id')->references('id')->on('intensifs')->onDelete('cascade');
            $table->foreign('manage_kelas_id')->references('id')->on('manage_kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_intensifs');
    }
}
