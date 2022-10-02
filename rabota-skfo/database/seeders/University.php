<?php

namespace Database\Seeders;

use App\Models\University as ModelsUniversity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class University extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $list = [
            [
                'fullName'=>'Северо-Кавказский федеральный Университет',
                'shortName'=>'СКФУ',
                'region'=>5,
                'email'=>'skfu@rabota.ru',
                'pic'=>'uploads/universities/ncfu.png',
            ],
            [
                'fullName'=>'Ставропольский государственный аграрный университет',
                'shortName'=>'СГАУ',
                'region'=>5,
                'email'=>'skgu@rabota.ru',
                'pic'=>'uploads/universities/agrar.jpeg',
            ],
            [
                'fullName'=>'Пятигорский государственный университет',
                'shortName'=>'ПГУ',
                'region'=>5,
                'email'=>'pgu@rabota.ru',
                'pic'=>'uploads/universities/pgu.png',
            ],
            [
                'fullName'=>'Кисловодский гуманитарно-технический институт',
                'shortName'=>'КГТИ',
                'region'=>5,
                'email'=>'kgti@rabota.ru',
                'pic'=>'uploads/universities/kgti.png',
            ],

            [
                'fullName'=>'Дагестанский государственный университет народного хозяйства',
                'shortName'=>'ДГУНХ',
                'region'=>1,
                'email'=>'dgunx@rabota.ru',
                'pic'=>'uploads/universities/narxoz.png',
            ],
            [
                'fullName'=>'Дагестанский государственный аграрный университет имени М.М. Джамбулатова',
                'shortName'=>'ДГАУ',
                'region'=>1,
                'email'=>'dgau@rabota.ru',
                'pic'=>'uploads/universities/dgau.png',
            ],
            [
                'fullName'=>'Дагестанский государственный университет',
                'shortName'=>'ДГУ',
                'region'=>1,
                'email'=>'dgu@rabota.ru',
                'pic'=>'uploads/universities/dgu.png',
            ],
            [
                'fullName'=>'Дагестанский государственный технический университет',
                'shortName'=>'ДГТУ',
                'region'=>1,
                'email'=>'dgtu@rabota.ru',
                'pic'=>'uploads/universities/dgtu.png',
            ],

            [
                'fullName'=>'Северо-Кавказская государственная гуманитарно-технологическая академия',
                'shortName'=>'СКГА',
                'region'=>6,
                'email'=>'skga@rabota.ru',
                'pic'=>'uploads/universities/skga.png',
            ],
            [
                'fullName'=>'Карачаево-Черкесский государственный университет',
                'shortName'=>'КЧГУ',
                'region'=>6,
                'email'=>'kchgu@rabota.ru',
                'pic'=>'uploads/universities/kchgu.png',
            ],

            [
                'fullName'=>'Кабардино-Балкарский государственный аграрный университет им. В.М. Кокова',
                'shortName'=>'КБГАУ',
                'region'=>3,
                'email'=>'kbgau@rabota.ru',
                'pic'=>'uploads/universities/kbgau.png',
            ],
            [
                'fullName'=>'Северо-Кавказский государственный институт искусств',
                'shortName'=>'СКГИИ',
                'region'=>3,
                'email'=>'skgii@rabota.ru',
                'pic'=>'uploads/universities/skgii.png',
            ],

            [
                'fullName'=>'Северо-Осетинский государственный университет имени К. Л. Хетагурова',
                'shortName'=>'СОГУ',
                'region'=>4,
                'email'=>'sogu@rabota.ru',
                'pic'=>'uploads/universities/sogu.png',
            ],

            [
                'fullName'=>'Ингушский государственный университет',
                'shortName'=>'ИГУ',
                'region'=>2,
                'email'=>'igu@rabota.ru',
                'pic'=>'uploads/universities/igu.png',
            ],

            [
                'fullName'=>'Чеченский государственный педагогический университет',
                'shortName'=>'ЧГПУ',
                'region'=>7,
                'email'=>'chgpu@rabota.ru',
                'pic'=>'uploads/universities/chgpu.png',
            ],
            [
                'fullName'=>'Грозненский государственный нефтяной технический университет имени академика М.Д. Миллионщикова',
                'shortName'=>'ГГНТ',
                'region'=>7,
                'email'=>'ggnt@rabota.ru',
                'pic'=>'uploads/universities/ggnt.png',
            ],
            [
                'fullName'=>'Чеченский государственный университет',
                'shortName'=>'ЧГУ',
                'region'=>7,
                'email'=>'chgu@rabota.ru',
                'pic'=>'uploads/universities/chgu.png',
            ],
            [
                'fullName'=>'Кабардино-Балкарский государственный университет',
                'shortName'=>'КБГУ',
                'region'=>3,
                'email'=>'kbgu@rabota.ru',
                'pic'=>'uploads/universities/kbgu.png',
            ],
            [
                'fullName'=>'Северо-Осетинская государственная медицинская академия',
                'shortName'=>'СОГМА',
                'region'=>4,
                'email'=>'sogma@rabota.ru',
                'pic'=>'uploads/universities/sogma.png',
            ],
            [
                'fullName'=>'Северо-Кавказский горно-металлургический институт',
                'shortName'=>'СКГМИ',
                'region'=>4,
                'email'=>'skgmi@rabota.ru',
                'pic'=>'uploads/universities/skgmi.png',
            ]
        ];
        foreach ($list as $item) {
            $university = ModelsUniversity::create([
                'fullName'=>$item['fullName'],
                'shortName'=>$item['shortName']
            ]);
            $user = User::create([
                'name'=>$item['fullName'],
                'role'=>'university',
                'email'=>$item['email'],
                'pic'=>$item['pic'],
                'phone'=>'',
                'details'=>$university->id,
                'region_id'=>$item['region'],
                'password'=>"univer_admin"
            ]);
        }
    }
}
