<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('position');
            $table->string('alt_contact');
            $table->text('duties');
            $table->text('conditions');
            $table->integer('salary_from');
            $table->integer('salary_to');
            $table->boolean('salary_by_agreement');
            $table->string('experience');
            $table->string('education');
            $table->string('sex');
            $table->string('tech_knowledges');
            $table->string('driver_license');
            $table->text('bonuses');
            $table->text('additional_requirements');
            $table->text('additional_info');
            $table->text('quize');
            $table->boolean('is_active');
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
        Schema::dropIfExists('vacancies');
    }
}
