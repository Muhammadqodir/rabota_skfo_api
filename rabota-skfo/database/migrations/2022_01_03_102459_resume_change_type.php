<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResumeChangeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->text('alt_contact')->change();
            $table->text('education')->change();
            $table->text('experience')->change();
            $table->text('langs')->change();
            $table->text('skills')->change();
            $table->text('achievements')->change();
            $table->text('interests')->change();
            $table->text('additional_info')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
