<?php

namespace App\Imports;

use App\Models\Resume;
use App\Models\Student;
use App\Models\User;
use Dotenv\Util\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $region_id = Auth::user()->region_id;
        $univer = Auth::user()->getDetails();
        $first = true;
        foreach($collection as $row){
            if($first){
                $first = false;
                continue;
            }
            $email = $row[5];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (User::where('email', '=', $email)->count() > 0) {
                    continue;
                }

                $name = $row[0];
                $faculty = $row[1];
                $speciality = $row[2];
                $sex = $row[3];
                $bDay = $row[4];
                $password = $row[6];
                $phone = $row[7];
                $position = $row[8];
                $skills = $row[9];
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
