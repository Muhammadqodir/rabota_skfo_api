<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChangePassUniversity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'university')->get();

        foreach($users as $user){
            $user->password = Hash::make("qwerty");
            $user->save();
        }
    }
}
