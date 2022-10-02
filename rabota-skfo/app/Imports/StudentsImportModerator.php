<?php

namespace App\Imports;

use App\Models\Region;
use App\Models\Resume;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImportModerator implements ToCollection
{
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $first = true;
        foreach($collection as $row){
            if($first){
                $first = false;
                continue;
            }
            $email = $row[3];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (User::where('email', '=', $email)->count() > 0) {
                    continue;
                }

                $name = $row[0];
                $sex = $row[1];
                $bDay = $row[2];
                $phone = $row[4];
                $password = $row[5];
                
                $region_id = -1;
                $region = Region::where('name', $row[6])->first();
                if($region != null){
                    $region_id = $region->id;
                }else{
                    return;
                }
                
                $univer_id = -1;
                $univer = University::where('shortName', $row[7])->first();
                if($univer != null){
                    $univer_id = $univer->id;
                }else{
                    return;
                }

                $faculty = $row[8];
                $speciality = $row[9];
                $position = $row[10];
                $skills = $row[11];
                $edu = [];
                $edu[] = [
                    "eduType" => "Очная",
                    "eduName" => $univer->fullName,
                    "eduFaculty" => $faculty,
                    "eduSpeciality" => $speciality,
                    "eduStart" => '',
                    "eduEnd" => '',
                    "checkEduNowDays" => 'false',
                ];
                $education = json_encode($edu);

                $student = new Student();
                $student->bday = $bDay;
                if(strtolower($sex) == 'м'){
                    $student->sex = 'm';
                }else{
                    $student->sex = 'f';
                }
                $student->university_id = $univer->id;
                $student->save();

                $user = new User();
                $user->name = $name;
                $user->role = 'student';
                $user->phone = $phone;
                $user->region_id = $region_id;
                $user->email = $email;
                $user->password = $password;
                $user->details = $student->id;
                $task = $user->save();
                event(new Registered($user));

                $resume = new Resume();
                $resume->user_id = $user->id;
                $resume->citizenship = "Россия";
                $resume->alt_contact = "[]";
                $resume->position = $position;
                $resume->salary = 0;
                $resume->salary_by_agreement = false;
                $resume->b_trip = false;
                $resume->moving = false;;
                $resume->employment_type = 0;
                $resume->education = $education;
                $resume->experience = "[]";
                $resume->langs = "[]";
                $resume->skills = "[]";
                $resume->driver_license = "{\"A\":false,\"B\":false,\"C\":false,\"D\":false,\"E\":false}";
                $resume->achievements = "[]";
                $resume->family_status = "Холост / Незамужем";
                $resume->interests = "";
                $resume->additional_info = "Навыки:\n".$skills;
                $resume->save();
            }
        }
    }
}
