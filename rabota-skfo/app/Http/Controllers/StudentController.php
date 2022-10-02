<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Response;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function addToFav(Request $request){
        $user_id = Auth::user()->id;
        if(!$request->has('id')){
            return json_encode([
                'success'=>false,
                'msg'=>'Bad request'
            ]);
        }
        $fav = Favorite::where('user_id', $user_id)->where('target_id', $request->id)->where('target_type', 'vacancy')->first();
        if($fav != null){
            $fav->delete();
        }else{
            $fav = new Favorite();
            $fav->user_id = $user_id;
            $fav->target_id = $request->id;
            $fav->target_type = 'vacancy';
            $fav->save();
        }
        return json_encode([
            'success'=>true,
            'msg'=>'ok'
        ]);
    }

    public function subscribe(Request $request){
        $user_id = Auth::user()->id;
        if(!$request->has('id')){
            return json_encode([
                'success'=>false,
                'msg'=>'Bad request'
            ]);
        }
        $fav = Subscription::where('user_id', $user_id)->where('target_id', $request->id)->where('target_type', 'org')->first();
        if($fav != null){
            $fav->delete();
        }else{
            $fav = new Subscription();
            $fav->user_id = $user_id;
            $fav->target_id = $request->id;
            $fav->target_type = 'org';
            $fav->save();
        }
        return json_encode([
            'success'=>true,
            'msg'=>'ok'
        ]);
    }

    public function profilePage(){
        return view('profile', ['user'=>Auth::user()]);
    }

    public function respondsPage(){
        $responds = Auth::user()->getResume()->getResponses();
        $hasResume = Auth::user()->getDetails()->hasResume();
        Auth::user()->getDetails()->viewResponds();
        return view('st_responds', ['responds'=>$responds, 'hasResume'=>$hasResume]);
    }
}
