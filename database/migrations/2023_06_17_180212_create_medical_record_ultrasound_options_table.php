<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordUltrasoundOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_record_ultrasound_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('medical_record_id');
            $table->unsignedInteger('ultrasound_option_id');
            $table->string('ultrasound_option_name');
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
        Schema::dropIfExists('medical_record_ultrasound_options');
    }
}
