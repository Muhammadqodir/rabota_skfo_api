<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('citizenship');
            $table->string('alt_contact');
            $table->string('position');
            $table->integer('salary');
            $table->boolean('salary_by_agreement');
            $table->boolean('b_trip');
            $table->boolean('moving');
            $table->string('employment_type');
            $table->string('education');
            $table->string('experience');
            $table->string('langs');
            $table->string('skills');
            $table->string('driver_license');
            $table->string('achievements');
            $table->string('interests');
            $table->string('additional_info');
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
        Schema::dropIfExists('resumes');
    }
}
