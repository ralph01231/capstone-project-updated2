<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('guidelines_during');
        
        Schema::create('guidelines_during', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guidelines_id');
            $table->string('headings');
            $table->string('image');
            $table->text('description');
            $table->timestamps();
            $table->foreign('guidelines_id')
                  ->references('guidelines_id')
                  ->on('guidelines')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('guidelines_during');
    }
};
