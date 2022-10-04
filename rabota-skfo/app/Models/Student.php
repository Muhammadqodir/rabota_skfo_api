<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpParser\Node\Expr\FuncCall;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'bday',
        'sex',
        'course',
        'speciality',
        'university_id',
        'degree'
    ];
    
    protected $attributes = [
        'course' => -1,
        'speciality' => '',
        'degree' => '',
    ];

    public function getAge(){
        $birthDate = explode(".", $this->bday);

        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    public function isFav($id){
        $fav = Favorite::where('user_id', $this->getUser()->id)->where('target_id', $id)->where('target_type', 'vacancy')->first();
        if($fav){
            return true;
        }else{
            return false;
        }
    }

    public function isSubscribed($id){
        $fav = Subscription::where('user_id', $this->getUser()->id)->where('target_id', $id)->where('target_type', 'org')->first();
        if($fav){
            return true;
        }else{
            return false;
        }
    }

    public function getUser(){
        return User::where([
            ['role', '=', 'student'],
            ['details', '=', $this->id]
        ])
        ->first();
    }

    public function getFavs(){
        $favs = Favorite::where('user_id', $this->getUser()->id)->where('target_type', 'vacancy')->get();
        return $favs;
    }

    public function getSubscriptions(){
        $favs = Subscription::where('user_id', $this->getUser()->id)->where('target_type', 'org')->get();
        return $favs;
    }

    public function getResume(){
        $resume = new Resume();
        if(Resume::where('user_id', $this->getUser()->id)->count() > 0){
            $resume = Resume::where('user_id', $this->getUser()->id)->get()[0];
        }
        return $resume;
    }

    public function getTraffic(){
        if(Resume::where('user_id', $this->id)->get() == null){
            return 0;
        }
        return count($this->getResume()->getViews());
    }

    public function getUniversity(){
        return University::find($this->university_id);
    }

    public function hasResume(){
        if(Resume::where('user_id', $this->getUser()->id)->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getLastRespondsView(){
        $view = View::where('target_type', 'responds')
                    ->where('user_id', $this->getUser()->id)->first();
        if($view != null){
            return $view->updated_at;
        }
        return "";
    }

    public function viewResponds(){
        $view = View::where('target_type', 'responds')
                    ->where('user_id', $this->getUser()->id)->first();
        if($view != null){
            return $view->touch();
        }else{
            $view = new View();
            $view->target_type = 'responds';
            $view->user_id = $this->getUser()->id;
            $view->target_id =  $this->getUser()->id;
            return $view->save();
        }
    }

    public function getResponses(){
        if($this->hasResume()){
            $lastView = $this->getLastRespondsView();
            if($lastView == ""){
                return Response::where('target_id', $this->getResume()->id)->count();
            }else{
                $from = Carbon::parse($lastView);
                return Response::where('target_id', $this->getResume()->id)->where('created_at', ">=", $from)->count();
            }
        }else{
            return 0;
        }
    }
}
