<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('guidelines');

        Schema::create('guidelines', function (Blueprint $table) {
            $table->id('guidelines_id');
            $table->string('guidelines_name');
            $table->string('thumbnail');
            $table->string('disaster_type');
            $table->timestamps();

            $table->engine = 'InnoDB';

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('guidelines');
    }
};
