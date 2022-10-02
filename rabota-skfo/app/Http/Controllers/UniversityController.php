<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Http\Requests\StudentProfileUpdate;
use App\Models\Resume;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{

    public function profilePage(){
        return view('profile', ['user'=>Auth::user()]);
    }

    public function getUniversities(){
        return University::all();
    }

    public function getAllUniversitiesPage(){
        $universities = University::all();
        return view('universities', ['universities' => $universities]);
    }

    public function getUniversitiesByRegion(Request $request){
        $selectedId = -1;
        if(Auth::check()){
            if(Auth::user()->role == 'student'){
                $student = Auth::user()->getDetails();
                if($student != null){
                    $selectedId = $student->university_id;
                }
            }
        }
        
        $all = University::all();
        $result = [];
        foreach ($all as $item) {
            if($item->getUser()->region_id == $request->id){
                array_push($result, $item);
            }
        }
        return [$result, $selectedId];
    }

    public function staticticsPage(){
        $region_id = Auth::user()->region_id;
        $data = [
            'users'=>StatisticsController::usersByRegion($region_id),
            'active_vacancies'=>StatisticsController::activeVacanciesByRegion($region_id),
            'resumes'=>StatisticsController::resumesByRegion($region_id),
            'orgs'=>StatisticsController::orgByRegion($region_id),
            'traffic'=>StatisticsController::getTrafficByRegion($region_id, 0),
        ];

        return view('univer_stat', $data);
    }

    public function studentsPage(Request $request){
        $univer_id = Auth::user()->getDetails()->id;
        if($request->has('q')){
            $students = User::select('users.*')->join('students', 'students.id', '=', 'users.details')->where('users.role', 'student')->where('students.university_id', $univer_id)->where('users.name', 'like', '%'.$request->q.'%')->paginate(10);
            $students->appends(['q' => $request->q]);
            return view('univer_students', ['students'=>$students]);
        }
        $students = User::select('users.*')->join('students', 'students.id', '=', 'users.details')->where('users.role', 'student')->where('students.university_id', $univer_id)->paginate(10);
        return view('univer_students', ['students'=>$students]);
    }

    public function editResume($user_id){
        $univer_id = Auth::user()->getDetails()->id;
        $student = User::where('role', 'student')->where('id', $user_id)->first();
        if($student->getDetails()->university_id != $univer_id){
            return view("errors.404");
        }
        
        if($student != null){
            return view('edit_resume', ['student'=>$student, 'submit_url'=>route('univer.editResumePost')]);
        }
        return view("errors.404");
    }

    public function saveResume(ResumeRequest $request){

        
        if(User::find($request->user_id)->getDetails()->university_id != Auth::user()->details){
            return abort(403, 'Unauthorized action.');
        }

        $resume = new Resume();
        if(Resume::where('user_id', $request->user_id)->count() > 0){
            $resume = Resume::where('user_id', $request->user_id)->get()[0];
        }

        $resume->user_id = $request->user_id;
        $resume->citizenship = $request->citizenship;
        $resume->alt_contact = $request->alt_contact;
        $resume->position = $request->position;
        $resume->salary = intval($request->salary);
        $resume->salary_by_agreement = $request->salary_by_agreement == "true" ? true: false;;
        $resume->b_trip = $request->b_trip == "true" ? true: false;
        $resume->moving = $request->moving == "true" ? true: false;;
        $resume->employment_type = $request->employment_type;
        $resume->education = $request->education;
        $resume->experience = $request->experience;
        $resume->langs = $request->langs;
        $resume->skills = $request->skills;
        $resume->driver_license = $request->driver_license;
        $resume->achievements = $request->achievements;
        $resume->family_status = $request->family_status;
        $resume->interests = is_null($request->interests) ? "": $request->interests;
        $resume->additional_info = is_null($request->additional_info) ? "": $request->additional_info;
        $saveTask = $resume->save();

        return $saveTask;
    }

    public function editProfile($user_id){

        $student = User::find($user_id);
        if($student->getDetails()->university_id != Auth::user()->details){
            return view("errors.404");
        }
        if($student != null){
            return view('edit_profile', ['user'=>$student]);
        }
        return view("errors.404");
    }

    public function removeStudent($id){
        
        $user = User::find($id);

        if($user->getDetails()->university_id != Auth::user()->details){
            return abort(403, 'Unauthorized action.');
        }
        if($user != null){
            $student = $user->getDetails();
            if($student->hasResume()){
                $student->getResume()->delete();
            }
            $student->delete();
            $user->delete();
        }
        return redirect(route('univer.students'));
    }

    
    public function updateStudentProfile(StudentProfileUpdate $request){
        $file = $request->file("userPic");
        $user = User::find($request->user_id);

        if($user->getDetails()->university_id != Auth::user()->details){
            return abort(403, 'Unauthorized action.');
        }
        
        if($user != null){
            if($file != null){
                $fileName = 'user_'.Auth::user()->id.'.'.$file->extension();
                $file->move(public_path('uploads'), $fileName);
                CropImageController::squareCrop(public_path('uploads').'/'.$fileName);
                $user->pic = 'uploads/'.$fileName;
            }
            $user->name = $request->input('fullName');
            $user->phone = $request->input('phoneNumber');
            $details = $user->getDetails();
            if($user->region_id != $request->input('region')){
                $user->region_id = $request->input('region');
                if($details->hasResume()){
                    $resume = $details->getResume();
                    $resume->region_id = $request->input('region');
                    $resume->save();
                }
            }
            $details->bday = $request->input('burnDate');
            if($request->input('speciality') != null){
                $details->speciality = $request->input('speciality');
            }else{
                $details->speciality = '';
            }
            $details->sex = $request->input('sex');
            $details->university_id = $request->input('univer');
            $details->save();
            $user->save();
            return back()->with('alert', 'Данные обновлены!');
        }else{
            abort(404, "user fot found");
        }
    }

}
