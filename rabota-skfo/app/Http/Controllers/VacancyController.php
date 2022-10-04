<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Jobs\SubscriptionNotifier;
use App\Models\Vacancy;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function createVacancy(VacancyRequest $request){    
	$vacancy = new Vacancy();

        $vacancy_id = $request->vacancy_id;

        if($vacancy_id != -1){
            if(Vacancy::where('id', $vacancy_id )->exists()){
                $vacancy = Vacancy::find($vacancy_id);
                if($vacancy->user_id != Auth::user()->id){
                    abort(403, 'Unauthorized action.'); 
                }
            }else{
                abort(403, 'Unauthorized action.'); 
            }
        }

        $vacancy->user_id = Auth::user()->id;
        $vacancy->position = $request->position;
        $vacancy->alt_contact = $request->alt_contact;
        $vacancy->conditions = $request->conditions;
        $vacancy->duties = $request->duties;

        $vacancy->salary_from = intval($request->salary_from);
        $vacancy->salary_to = intval($request->salary_to);
        $vacancy->salary_by_agreement = $request->salary_by_agreement == "true" ? true: false;
	$vacancy->is_for_dp = $request->is_for_dp == "true" ? true : false;
	$vacancy->social_package = $request->social_package == "" ? "-" : $request->social_package;
        $vacancy->experience = $request->experience;
        $vacancy->education = $request->education;
        $vacancy->sex = $request->sex;
        $vacancy->tech_knowledges = $request->tech_knowledges;
        $vacancy->bonuses = $request->bonuses;
        $vacancy->driver_license = $request->driver_license;
        $vacancy->is_active = true;
        $vacancy->additional_info = is_null($request->additional_info) ? "": $request->additional_info;
        $vacancy->quize = is_null($request->quize) ? "": $request->quize;
        $vacancy->additional_requirements = is_null($request->additional_requirements) ? "": $request->additional_requirements;
        $saveTask = $vacancy->save();
        SubscriptionNotifier::dispatch($vacancy->getUser()->getDetails()->id, $vacancy->id);
        return $saveTask;
    }

    public function editVacancy($id){
        $vacancy = Vacancy::find($id);
        if($vacancy != null){
            if($vacancy->user_id == Auth::user()->id){
                return view('edit_vacancy', ['vacancy'=>$vacancy]);
            }else{
                return abort(403, 'Unauthorized action.'); 
            }
        }else{
            return view('errors.404');
        }
    }

    public function setIsActive(Request $request){
        if($request->has('id') && $request->has('value')){
            $id = $request->id;
            $value = $request->value == 0 ? 0 : 1;
            $vacancy = Vacancy::find($id);
            if($vacancy != null){
                if($vacancy->user_id == Auth::user()->id || Auth::user()->role == 'moderator'){
                    $vacancy->is_active = $value;
                    $vacancy->save();
                    return json_encode([
                        "success"=>true,
                        "msg"=>"Done"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "msg"=>"Unauthorized action"
                    ]);
                }
            }else{
                return json_encode([
                    "success"=>false,
                    "msg"=>"Invalid id"
                ]);
            }
        }else{
            return json_encode([
                "success"=>false,
                "msg"=>"Bad Request"
            ]);
        }
    }

    public function removeVacancy(Request $request){
        if($request->has('id')){
            $id = $request->id;
            $vacancy = Vacancy::find($id);
            if($vacancy != null){
                if($vacancy->user_id == Auth::user()->id || Auth::user()->role == 'moderator'){
                    $vacancy->delete();
                    return json_encode([
                        "success"=>true,
                        "msg"=>"Done"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "msg"=>"Unauthorized action"
                    ]);
                }
            }else{
                return json_encode([
                    "success"=>false,
                    "msg"=>"Invalid id"
                ]);
            }
        }else{
            return json_encode([
                "success"=>false,
                "msg"=>"Bad Request"
            ]);
        }
    }

    public function vacancyDetails($id){
        $vacancy = Vacancy::find($id);
        if($vacancy != null){
            if($vacancy->is_active){
                $vacancy->newView();
                return view('vacancy_details', ['vacancy'=>$vacancy]);
            }else{
                return view("errors.404");
            }
        }else{
            return view("errors.404");
        }
    }

    public function getContacts(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if($request->has('vacancy_id')){
                $vacancy = Vacancy::find($request->vacancy_id);
                if($vacancy != null){
                    $vacancy->contactRequest();
                    return json_encode([
                        "success"=>true,
                        "message"=>"ok"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "message"=>"Invalid vacancy_id"
                    ]);
                }
            }else{
                abort(400, "Bad Request");
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    public static function getPopularVacancies(){
        $popVac = $user_info = DB::table('views')
        ->select('target_id', DB::raw('count(target_id) as total'))->where('target_type', 'vacancy')
        ->groupBy('target_id')
        ->orderBy('total', 'desc')
        ->take(10)->get();
        $vacancies = [];
        foreach($popVac as $vac){
            $vacancy = Vacancy::find($vac->target_id);
            if($vacancy != null){
                if($vacancy->is_active){
                    $vacancies[] = $vacancy;
                }
            }
        }
        return $vacancies;
    }
}
