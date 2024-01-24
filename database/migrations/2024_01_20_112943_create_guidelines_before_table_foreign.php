<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('guidelines_before', function (Blueprint $table) {
            $table->foreign('guidelines_id')
                ->references('guidelines_id')
                ->on('guidelines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            // Add an index to guidelines_id column
            $table->index('guidelines_id');
        });
    }

    public function down()
    {
        Schema::table('guidelines_before', function (Blueprint $table) {
            $table->dropForeign(['guidelines_id']);
        });
    }
};
