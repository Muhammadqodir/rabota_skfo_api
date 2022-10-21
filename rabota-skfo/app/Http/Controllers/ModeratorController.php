<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Http\Requests\StudentProfileUpdate;
use App\Http\Requests\UniverProfileRequest;
use App\Models\Resume;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
    public function profilePage(){
        $user = Auth::user();
        if($user->api_token == null){
            $user->updateApiToken();
        }
        return view('profile', ['user'=>Auth::user()]);
    }

    public function updateApiToken(){
        $user = Auth::user();
        $user->updateApiToken();
        return $user->api_token;
    }

    public function staticticsPage(){
        $region_id = Auth::user()->region_id;
        $data = [
            'users'=>StatisticsController::getAllUsersCount(),
            'active_vacancies'=>StatisticsController::activeVacancies(),
            'resumes'=>StatisticsController::getAllResume(),
            'univers'=>StatisticsController::getUnivers(),
            'orgs'=>StatisticsController::getAllOrgCount(),
            'traffic'=>StatisticsController::getAllTraffic(0),
        ];

        return view('md_stat', $data);
    }

    public function studentsPage(Request $request){
        if($request->has('q')){
            $students = User::where('role', 'student')->where('name', 'like', '%'.$request->q.'%')->paginate(10);
            $students->appends(['q' => $request->q]);
            return view('md_students', ['students'=>$students]);
        }
        $students = User::where('role', 'student')->paginate(10);
        return view('md_students', ['students'=>$students]);
    }

    public function universPage(Request $request){
        if($request->has('q')){
            $univers = User::where('role', 'university')->where('name', 'like', '%'.$request->q.'%')->paginate(10);
            $univers->appends(['q' => $request->q]);
            return view('md_univers', ['univers'=>$univers]);
        }
        $univers = User::where('role', 'university')->paginate(10);
        return view('md_univers', ['univers'=>$univers]);
    }

    public function employersPage(Request $request){
        if($request->has('q')){
            $organizations = User::select('users.*')->where('users.role', 'organization')->join('organizations', 'organizations.id', '=', 'users.details')->where('organizations.name', 'like', '%'.$request->q.'%')->paginate(10);
            $organizations->appends(['q' => $request->q]);
            return view('md_employers', ['organizations'=>$organizations]);
        }
        $organizations = User::where('role', 'organization')->paginate(10);
        return view('md_employers', ['organizations'=>$organizations]);
    }


    public function vacanciesPage(Request $request){
        $vacancies_query = Vacancy::where('position', '<>', '');
        if($request->has('q')){
            $vacancies_query = $vacancies_query->where('position', 'like', '%'.$request->q.'%');
        }
        if($request->has('org')){
            $vacancies_query = $vacancies_query->where('user_id', $request->org);
        }
        $vacancies = $vacancies_query->paginate(10);
        if($request->has('q')){
            $vacancies->appends(['q' => $request->q]);
        }
        return view('md_vacancies', ['vacancies'=>$vacancies]);
    }


    public function removeStudent($id){
        $user = User::find($id);
        if($user != null){
            $student = $user->getDetails();
            if($student->hasResume()){
                $student->getResume()->delete();
            }
            $student->delete();
            $user->delete();
        }
        return redirect(route('moderator.students'));
    }

    public function editResume($user_id){
        $univer_id = Auth::user()->id;
        $student = User::where('role', 'student')->where('id', $user_id)->first();
        
        if($student != null){
            return view('edit_resume', ['student'=>$student, 'submit_url'=>route('moderator.editResumePost')]);
        }
        return view("errors.404");
    }

    public function saveResume(ResumeRequest $request){

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

        $user = User::find($user_id);
        if($user != null){
            return view('edit_profile', ['user'=>$user]);
        }
        return view("errors.404");
    }

    public function updateStudentProfile(StudentProfileUpdate $request){
        $file = $request->file("userPic");
        $user = User::find($request->user_id);
        
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

    public function updateUniverProfile(UniverProfileRequest $request){
        $file = $request->file("userPic");
        $user = User::find($request->user_id);

        if($file != null){
            $fileName = 'user_'.Auth::user()->id.'.'.$file->extension();
            $file->move(public_path('uploads'), $fileName);
            CropImageController::squareCrop(public_path('uploads').'/'.$fileName);
            $user->pic = 'uploads/'.$fileName;
        }
        $user->name = $request->input('fullName');
        if($request->phoneNumber != ""){
            $user->phone = $request->input('phoneNumber');
        }else{
            $user->phone = '';
        }
        $user->region_id = $request->input('region');
        $details = $user->getDetails();
        $details->fullName = $request->input('fullName');
        $details->shortName = $request->input('shortName');
        $details->save();
        $user->save();
        return back()->with('alert', 'Данные обновлены!');
    }
}
