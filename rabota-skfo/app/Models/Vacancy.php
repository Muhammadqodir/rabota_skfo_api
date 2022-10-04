<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'position',
        'alt_contact',
        'duties',
        'conditions',
        'salary_from',
        'salary_to',
        'salary_by_agreement',
        'experience',
        'education',
        'sex',
        'tech_knowledges',
        'driver_license',
        'bonuses',
        'additional_requirements',
        'additional_info',
        'quize',

	'is_active',
	'is_for_dp',
	'social_package'
    ];

    protected $attributes = [
        'is_for_dp' => false,
        'social_package' => '-'
    ];


    public function getUser(){
        return User::find($this->user_id);
    }

    public function getOrg(){
        return User::find($this->user_id)->getDetails();
    }

    public function getSalaryGap(){
        if($this->salary_by_agreement || $this->salary_from <= 0){
            return "по договоренности";
        }else{
            if($this->salary_to <= 0){
                return "от ".$this->salary_from.' ₽';
            }else{
                return "от " . $this->salary_from . ' ₽ - ' . $this->salary_to . ' ₽';
            }
        }
    }

    public function getRegion(){
        return $this->getUser()->getRegionName();
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

    public function getContacts(){
        return json_decode($this->alt_contact);
    }
    
    public function getBonuses(){
        return json_decode($this->bonuses);
    }
    
    public function getDL(){
        return json_decode($this->driver_license);
    }

    public function getViews(){
        return View::where('target_type', 'vacancy')->where('target_id', $this->id)->get();
    }

    public function newView(){
        $user_id = -1;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        if($user_id != $this->getUser()->id){
            $last_view = View::where('target_type', 'vacancy')->where('user_id', $user_id)->where('target_id', $this->id)->whereDate('created_at', Carbon::today())->first();
            if($last_view == null){
                $view = new View();
                $view->user_id = $user_id;
                $view->target_type = "vacancy";
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
            $last_view = View::where('target_type', 'vacancy_contact')->where('user_id', $user_id)->where('target_id', $this->id)->whereDate('created_at', Carbon::today())->first();
            if($last_view == null){
                $view = new View();
                $view->user_id = $user_id;
                $view->target_type = "vacancy_contact";
                $view->target_id = $this->id;
                $view->save();
            }
        }
    }

    public function getContactRequests(){
        return View::where('target_type', 'vacancy_contact')->where('target_id', $this->id)->get();
    }
}
