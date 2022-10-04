<?php

namespace App\Models;

use App\Http\Controllers\MailController;
use App\Jobs\ResponseNotify;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'citizenship',
        'alt_contact',
        'position',
        'salary',
        'salary_by_agreement',
        'b_trip',
        'moving',
        'employment_type',
        'education',
        'experience',
        'langs',
        'skills',
        'driver_license',
        'achievements',
        'interests',
        'additional_info',
        'family_status'
    ];

    protected $attributes = [
        'salary' => 0,
        'position' => "",
        'alt_contact' => '[]',
        'salary_by_agreement' => false,
        'b_trip' => false,
        'moving' => false,
        'education' => '[]',
        'experience' => '[]',
        'langs' => '[]',
        'skills' => '[]',
        'driver_license' => '[]',
        'achievements' => '[]',
        'interests' => '',
        'additional_info' => '',
        'family_status' => ''
    ];

    public function getUser(){
        return User::find($this->user_id);
    }

    public function getPosition(){
        return $this->position;
    }


    public function getFamilyStatus(){
	    if($this->getUser()->getDetails()->sex == "m"){
		if($this->family_status == "Холост / Незамужем"){
			return "Холост";
		}else{
			return "В браке";
		}
	    }else{
		if($this->family_status == "Холост / Незамужем"){
                        return "Незамужем";
                }else{
                        return "В браке";
                }
	    }
    }

    public function getExperience(){
        return json_decode($this->experience);
    }

    public function getEducation(){
        return json_decode($this->education);
    }

    public function getLangs(){
        return json_decode($this->langs);
    }

    public function getSkills(){
        return json_decode($this->skills);
    }

    public function getSkillsString(){
        $skills = "";
        foreach( $this->getSkills() as $skill){
            $skills .= $skill.", ";
        }
        return $skills;
    }

    public function getDL(){
        return json_decode($this->driver_license);
    }

    public function getAchievements(){
        return json_decode($this->achievements);
    }

    public function getContacts(){
        return json_decode($this->alt_contact);
    }

    public function getSalary(){
        return number_format(strval($this->salary)) . " руб.";
    }

    public function getDLString(){
        $dl = $this->getDL();
        $res = "";
        foreach ($dl as $key => $value) {
            if($value){
                $res .= $key . ', ';
            }
        }
        return substr_replace($res ,"", -2);
    }

    public function newView(){
        $user_id = -1;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        if($user_id != $this->getUser()->id){
            $last_view = View::where('target_type', 'resume')->where('user_id', $user_id)->where('target_id', $this->id)->whereDate('created_at', Carbon::today())->first();
            if($last_view == null){
                $view = new View();
                $view->user_id = $user_id;
                $view->target_type = "resume";
                $view->target_id = $this->id;
                $view->save();
            }
        }
    }

    public function contactRequest(){
        $user_id = -1;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        if($user_id != $this->getUser()->id){
            $last_view = View::where('target_type', 'resume_contact')->where('user_id', $user_id)->where('target_id', $this->id)->whereDate('created_at', Carbon::today())->first();
            if($last_view == null){
                $view = new View();
                $view->user_id = $user_id;
                $view->target_type = "resume_contact";
                $view->target_id = $this->id;
                $view->save();
            }
        }
    }

    public function download(){
        $user_id = -1;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        if($user_id != $this->getUser()->id){
            $view = new Download();
            $view->user_id = $user_id;
            $view->target_type = "resume";
            $view->target_id = $this->id;
            $view->save();
        }
    }

    public function getViews(){
        return View::where('target_type', 'resume')->where('target_id', $this->id)->get();
    }

    public function getDownloads(){
        return Download::where('target_type', 'resume')->where('target_id', $this->id)->get();
    }

    public function getResponses(){
        return Response::where('target_type', 'resume')->where('target_id', $this->id)->get();
    }

    public function newResponse($msg){
        $user_id = -1;
        if(Auth::check()){
            if(Auth::user()->role == 'organization'){
                $user_id = Auth::user()->id;
            }else{
                return abort(401, 'unauthorized access');
            }
        }else{
            return abort(401, 'unauthorized access');
        }
        $response = new Response();
        $response->user_id = $user_id;
        $response->target_id = $this->id;
        $response->target_type = 'resume';
        $response->message = $msg;
        $response->save();
        ResponseNotify::dispatch($response->id, $this->getUser()->id, Auth::user()->id);
    }

    public function getContactRequests(){
        return View::where('target_type', 'resume_contact')->where('target_id', $this->id)->get();
    }

    public function isResponsed($user_id){
        $response = Response::where('user_id', $user_id)->where("target_id", $this->id)->where("target_type", 'resume')->first();
        if($response != null){
            return true;
        }else{
            return false;
        }
    }
}
