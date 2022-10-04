<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Organization;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function getDetails($id){
        if(Organization::where('id', $id)->exists()){
            $org = Organization::find($id);
            $org->newGuest();
            return view("org_details", ["org"=>$org]);
        }else{
            return view("errors.404");
        }
    }

    public function addToFav(Request $request){
        $user_id = Auth::user()->id;
        if(!$request->has('id')){
            return json_encode([
                'success'=>false,
                'msg'=>'Bad request'
            ]);
        }
        $fav = Favorite::where('user_id', $user_id)->where('target_id', $request->id)->where('target_type', 'resume')->first();
        if($fav != null){
            $fav->delete();
        }else{
            $fav = new Favorite();
            $fav->user_id = $user_id;
            $fav->target_id = $request->id;
            $fav->target_type = 'resume';
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

    public function setActiveState(Request $request){
        if($request->has("id") && $request->has("value")){
            $user = User::find($request->id);
            if($user != null){
                $user->active = $request->value;
                $user->save();
                return json_encode([
                    "success"=>true,
                    "msg"=>"Done"
                ]);
            }
        }else{
            abort(400, "Bad request");
        }
    }

    public function removeOrg(Request $request){
        if($request->has("id")){
            $user = User::find($request->id);
            if($user != null){
                $org = $user->getDetails();
                Vacancy::where('user_id', $request->id)->delete();
                $org->delete();
                $user->delete();
                return json_encode([
                    "success"=>true,
                    "msg"=>"Done"
                ]);
            }
        }else{
            abort(400, "Bad request");
        }
    }
}
