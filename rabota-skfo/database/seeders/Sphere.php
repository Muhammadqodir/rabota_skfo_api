<?php

namespace Database\Seeders;

use App\Models\Sphere as ModelsSphere;
use Illuminate\Database\Seeder;

class Sphere extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = array(
            "Архитектура, строительство, дизайн",
            "Банки, инвестиции, кредит",
            "Временная работа, Фриланс, Работа на дому",
            "Гостинично - ресторанный бизнес",
            "Государственная служба",
            "Топ менеджмент",
	    "Торговля, Продажи",
	    "ИТ, технологии, интернет"
        );

        foreach ($positions as $item) {
            $sphere = new ModelsSphere();
            $sphere->name = $item;
            $sphere->save();
        }
    }
}
