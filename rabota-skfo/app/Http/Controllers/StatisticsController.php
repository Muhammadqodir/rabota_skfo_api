<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public static function usersByRegion($region_id){
        return count(User::where('region_id', $region_id)->get());
    }

    public static function getAllUsersCount(){
        return count(User::all());
    }

    public static function getAllOrgCount(){
        return count(User::where('role', 'organization')->get());
    }

    public static function orgByRegion($region_id){
        return count(User::where('region_id', $region_id)->where('role', 'organization')->get());
    }

    public static function activeVacanciesByRegion($region_id){
        $res = [];
        $orgs = User::where('role', 'organization')->where('region_id', $region_id)->get();
        foreach($orgs as $org){
            $res[] = $org->getDetails()->getActiveVacancies();
        }
        return count($res);
    }
    

    public static function activeVacancies(){
        $res = [];
        $count = 0;
        $orgs = User::where('role', 'organization')->get();
        foreach($orgs as $org){
            $res[] = $org->getDetails()->getActiveVacancies();
            $count+= count($org->getDetails()->getActiveVacancies());
        }
        return $count;
    }
    
    public static function resumesByRegion($region_id){
        $res = 0;
        $students = User::where('role', 'student')->where('region_id', $region_id)->get();
        foreach($students as $student){
            if($student->isResumeExist()){
                $res++;
            }
        }
        return $res;
    }

    public static function getAllResume(){
        $res = 0;
        $students = User::where('role', 'student')->get();
        foreach($students as $student){
            if($student->isResumeExist()){
                $res++;
            }
        }
        return $res;
    }

    public static function getTrafficByRegion($region_id, $period){
        $res = [];
        $all = View::where('created_at', '>', Carbon::now()->subDays(10))->get();

        foreach($all as $item){
            $date = date("d.m", strtotime($item->created_at));
            if(isset($res[$date])){
                $res[$date] += 1;
            }else{
                $res[$date] = 1;
            }
        }
        $labels = [];
        $values = [];
        foreach($res as $key=>$value){
            $labels[] = $key;
            $values[] = $value;
        }
        return json_encode([
            'labels'=>$labels,
            'values'=>$values,
        ]);
    }

    public static function getUnivers(){
        return count(User::where('role', 'university')->get());
    }

    public static function getAllTraffic($period){
        $res = [];
        $all = View::where('created_at', '>', Carbon::now()->subDays(10))->get();
        foreach($all as $item){
            $date = date("d.m", strtotime($item->created_at));
            if(isset($res[$date])){
                $res[$date] += 1;
            }else{
                $res[$date] = 1;
            }
        }
        $labels = [];
        $values = [];
        foreach($res as $key=>$value){
            $labels[] = $key;
            $values[] = $value;
        }
        return json_encode([
            'labels'=>$labels,
            'values'=>$values,
        ]);
    }
}
