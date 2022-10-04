<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowsToVacancy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacancies', function (Blueprint $table) {
		$table->boolean('is_for_dp')->default(0);
		$table->string('social_package')->default("-");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancy', function (Blueprint $table) {
            $table->dropColumn('is_for_dp');
                $table->dropColumn('social_package');
        });
    }
}
