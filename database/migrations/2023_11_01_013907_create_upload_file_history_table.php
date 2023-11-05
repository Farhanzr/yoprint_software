<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadFileHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_file_history', function (Blueprint $table) {
            $table->id('ID');
            $table->string('UPLOAD_ID', 15);
            $table->string('FILENAME');
            $table->string('STATUS_CODE');
            $table->string('CREATED_BY');
            $table->string('UPDATED_BY');
            $table->string('HASH', 64)->unique()->nullable();
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
        Schema::dropIfExists('upload_file_history');
    }
}
