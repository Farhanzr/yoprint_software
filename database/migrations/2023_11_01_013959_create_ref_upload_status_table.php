<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRefUploadStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_upload_status', function (Blueprint $table) {
            $table->id('ID');
            $table->string('CODE');
            $table->string('DESCRIPTION');
            $table->timestamps();
        });

        // Insert data
        DB::table('ref_upload_status')->insert(
            array(
                [
                    'CODE' => '0',
                    'DESCRIPTION' => 'PENDING',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'CODE' => '1',
                    'DESCRIPTION' => 'PROCESSING',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'CODE' => '2',
                    'DESCRIPTION' => 'SUCCESS',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'CODE' => '3',
                    'DESCRIPTION' => 'FAIL',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_upload_status');
    }
}
