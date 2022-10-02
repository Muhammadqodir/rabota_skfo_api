<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'name'=>'Республика Дагестан'
        ]);
        Region::create([
            'name'=>'Республика Ингушетия'
        ]);
        Region::create([
            'name'=>'Кабардино-Балкарская Республика'
        ]);
        Region::create([
            'name'=>'Республика Северная Осетия — Алания'
        ]);
        Region::create([
            'name'=>'Ставропольский край'
        ]);
        Region::create([
            'name'=>'Карачаево-Черкесская Республика'
        ]);
        Region::create([
            'name'=>'Чеченская Республика'
        ]);
    }
}
