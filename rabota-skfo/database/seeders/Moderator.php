<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Moderator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Админ',
            'role'=>'moderator',
            'email'=>'admin@admin.ru',
            'pic'=>'',
            'phone'=>'',
            'details'=>-1,
            'region_id'=>5,
            'password'=>"test_admin_123"
        ]);
    }
}
