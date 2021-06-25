<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSilabusPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('silabus_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('silabus_id');
            $table->text('title');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::table('silabus_points', function($table){
            $table->foreign('silabus_id')->references('id')->on('silabuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('silabus_points');
    }
}
