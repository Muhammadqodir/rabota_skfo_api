<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request){
        if(Hash::check($request->old_password, Auth::user()->password)){
            if($request->new_password == $request->new_password_retype){
                $user = Auth::user();
                $user->password = $request->new_password;
                $user->save();
                return Redirect::back()->with(['alert' => 'Готово!']);
            }else{
                return Redirect::back()->withErrors(['err_rpass' => 'Пароли не совпадают']);
            }
        }else{
            return Redirect::back()->withErrors(['err_rpass' => 'Неверный старый пароль']);
        }
    }
}
