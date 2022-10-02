<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $q = $request->has('q') ? $request->q : '';
        $type = $request->has('type') ? $request->type : '';
        if($type == 'resume'){
            $res = Resume::select('resumes.*')
                    ->join('users', 'users.id', '=', 'resumes.user_id')
                    ->where('resumes.position', 'like', '%'.$q.'%');
            if($request->region != 0 && $request->region != null){
                $res->where('users.region_id', $request->region);
            }
            if($request->exp != 0 && $request->exp != null){
                $res->where('resumes.experience', '<>', '[]');
            }
            if($request->sFrom > 0 && $request->sFrom != null){
                $res->where('resumes.salary', '>', $request->sFrom);
            }
            if($request->sTo > 0 && $request->sTo != null){
                $res->where('resumes.salary', '<', $request->sTo);
            }
            return view('search', ['data'=>$res->get(), 'trudvsem'=>[]]);
        }elseif($type == 'org'){
            return view('search', ['data'=>Organization::where('name', 'like', '%'.$q.'%')
                                ->orWhere('description', 'like', '%'.$q.'%')->get(), "trudvsem" => []]);
        }elseif($type == 'vacancy'){
            $res = Vacancy::select('vacancies.*')
            ->join('users', 'users.id', '=', 'vacancies.user_id')
            ->where('vacancies.is_active', 1)
            ->where(function($query) use($q){
                $query->where('vacancies.position', 'like', '%'.$q.'%')
                ->orWhere('vacancies.duties', 'like', '%'.$q.'%')
                ->orWhere('vacancies.additional_info', 'like', '%'.$q.'%');
            });
            if($request->region != 0 && $request->region != null){
                $res->where('users.region_id', $request->region);
            }
            if($request->exp != 0 && $request->exp != null){
                $res->where('vacancies.experience', '<>', 'Не имеет значения');
            }
            if($request->sFrom > 0 && $request->sFrom != null){
                $res->where('vacancies.salary_from', '>', $request->sFrom);
            }else if($request->sTo > 0 && $request->sTo != null){
                $res->where('vacancies.salary_to', '<', $request->sTo);
	    }

	    $region = '2600000000000';
            $regions = [
                '0500000000000',
                '0600000000000',
                '0700000000000',
                '1500000000000',
                '2600000000000',
                '0900000000000',
                '2000000000000'
            ];
            if($request->region != 0 && $request->region < 8 && $request->region != null){
                $region = $regions[$request->region-1];
            }
            $trudvsem = [];
            $json = json_decode(file_get_contents('https://opendata.trudvsem.ru/api/v1/vacancies/region/'.$region.'?text='.urlencode($request->q).'&offset=1&limit=100'), true);

	    if($json["status"] == 200){
		if($json["meta"]["total"] > 0){
		    $vacancies = $json["results"]["vacancies"];
		    $trudvsem = $json;
		}
	    }
	    //dd($trudvsem);	    
            return view('search', ['data'=>$res->get(), 'trudvsem'=>$trudvsem]);
        }
        return view('search');
    }
}
