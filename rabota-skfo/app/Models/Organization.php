<?php

namespace App\Models;

use App\Http\Requests\VacancyRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        "form",
        "name",
        "description",
        "web_site",
        "name",
        "sphere"
    ];
    
    protected $attributes = [
        'web_site' => '',
        "description" => '',
    ];

    public function getUser(){
        return User::where('details', $this->id)->where('role', 'organization')->first();
    }

    public function getVacancies(){
        return Vacancy::where('user_id', $this->getUser()->id)->get();
    }

    public function getVacanciesCount(){
        return Vacancy::where('user_id', $this->getUser()->id)->count();
    }

    public function getSphere(){
        return Sphere::find($this->sphere);
    }

    public function getOrgFullName(){
	if($this->form == "Другое"){
		return $this->name;
	}
        return $this->form . ' "'. $this->name . '"';;
    }

    public function getActiveVacancies(){
        return Vacancy::where('user_id', $this->getUser()->id)->where('is_active', 1)->get();
    }

    public function getGuests(){
        return View::where('target_type', 'org')->where('target_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    public function newGuest(){
        $user_id = -1;
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }
        if($user_id != $this->getUser()->id && $user_id != -1){
            $last_view = View::where('target_type', 'org')->where('user_id', $user_id)->where('target_id', $this->id)->whereDate('created_at', Carbon::today())->first();
            if($last_view == null){
                $view = new View();
                $view->user_id = $user_id;
                $view->target_type = "org";
                $view->target_id = $this->id;
                $view->save();
            }
        }
    }

    public function isFav($id){
        $fav = Favorite::where('user_id', $this->getUser()->id)->where('target_id', $id)->where('target_type', 'resume')->first();
        if($fav){
            return true;
        }else{
            return false;
        }
    }

    public function getFavs(){
        $favs = Favorite::where('user_id', $this->getUser()->id)->where('target_type', 'resume')->get();
        return $favs;
    }

    public function getTraffic(){
        $res = 0;
        $vacancies = $this->getVacancies();
        foreach($vacancies as $vacancy){
            $res += $vacancy->getViews();
        }
        return $res;
    }
}
