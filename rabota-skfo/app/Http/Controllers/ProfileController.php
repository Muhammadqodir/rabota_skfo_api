<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrgProfileUpadateRequest;
use App\Http\Requests\ProfilePhoto;
use App\Http\Requests\StudentProfileUpdate;
use App\Http\Requests\UniverProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function updateStudentProfile(StudentProfileUpdate $request){
        if(!Auth::check()){
            return redirect(route('user.login'));
        }
        $file = $request->file("userPic");
        $user = Auth::user();
        if($file != null){
            $fileName = 'user_'.Auth::user()->id.'.'.$file->extension();
            $file->move(public_path('uploads'), $fileName);
            CropImageController::squareCrop(public_path('uploads').'/'.$fileName);
            $user->pic = 'uploads/'.$fileName;
        }
        $user->name = $request->input('fullName');
        $user->phone = $request->input('phoneNumber');
        $details = $user->getDetails();
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
    }

    public function updateUniverProfile(UniverProfileRequest $request){
        if(!Auth::check()){
            return redirect(route('user.login'));
        }
        $file = $request->file("userPic");
        $user = Auth::user();
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

    public function updateOrganizationProfile(OrgProfileUpadateRequest $request){
        if(!Auth::check()){
            return redirect(route('user.login'));
        }
        $file = $request->file("userPic");
        $user = Auth::user();
        if($file != null){
            $fileName = 'user_'.Auth::user()->id.'.'.$file->extension();
            $file->move(public_path('uploads'), $fileName);
            CropImageController::squareCrop(public_path('uploads').'/'.$fileName);
            $user->pic = 'uploads/'.$fileName;
        }
        $user->name = $request->input('fullName');
        $user->phone = $request->input('phoneNumber');
        $details = $user->getDetails();

        $details->form = $request->input('orgForm');
        $details->name = $request->input('orgName');
        $details->sphere = $request->input('orgSphere');
        $details->description = $request->input('description');
        $details->web_site = $request->input('website');
        $details->save();
        $user->save();
        return back()->with('alert', 'Данные обновлены!');
    }
    
    public function profilePage(){
        $role = Auth::user()->role;
        switch ($role) {
            case 'student':
                return redirect(route('student.profile'));
            case 'organization':
                return redirect(route('org.profile'));
            case 'university':
                return redirect(route('univer.profile'));
            case 'moderator':
                return redirect(route('moderator.profile'));
            default:
                abort(404);
                break;
        }
    }
}
