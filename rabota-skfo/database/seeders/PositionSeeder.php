<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = array(
            "водитель",
            "менеджер проектов",
            "программист",
            "повар",
            "hr менеджер",
            "бухгалтер",
            "cетевой администратор",
            "разработчик мобильных приложение"
        );

        foreach ($positions as $item) {
            $position = new Position();
            $position->name = $item;
            $position->save();
        }
    }
}
