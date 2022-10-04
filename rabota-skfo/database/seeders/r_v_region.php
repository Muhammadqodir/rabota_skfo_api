<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class r_v_region extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'organization')->orWhere('role', 'student')->get();
        foreach($users as $user){
            Log::info($user->name);
            if($user->role == 'student')
            {
                $student = $user->getDetails();
                if($user->isResumeExist()){
                    $resume = $student->getResume();
                    Log::info($resume);
                    $resume->region_id = $user->region_id;
                    $resume->save();
                }else{
                    Log::info("no has resume");
                }
            }else if($user->role = 'organization'){
                $vacancies = Vacancy::where('user_id', $user->id);
                foreach($vacancies as $vacancy){
                    $vacancy->region_id = $user->region_id;
                    $vacancy->save();
                }
            }
        }
    }
}
