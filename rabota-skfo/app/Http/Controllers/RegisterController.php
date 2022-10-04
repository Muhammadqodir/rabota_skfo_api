<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRegisterRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Models\Organization;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    
    public function registerStudent(StudentRegisterRequest $request)
    {
        if(Auth::check()){
            return redirect(route('student.main'));
        }
        if(User::where('email', $request->input('email'))->exists()){
            return redirect(route("user.reg"))->withErrors([
                'email'=>'Пользователь с таким email уже сушествует'
            ]);
        }

        $student = new Student();
        $student->bday = $request->input('burnDate');
        $student->sex = $request->input('sex');
        $student->university_id = $request->input('univer');
        $student->save();

        $user = new User();
        $user->name = $request->input('fullName');
        $user->role = 'student';
        $user->phone = $request->input('phoneNumber');
        $user->region_id = $request->input('region');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->details = $student->id;
        $saveTask = $user->save();
        //forEmail
        // event(new Registered($user));
        if($saveTask){
            Auth::login($user);
            return redirect(route("main"));
        }else{
            return redirect(route('user.reg'))->withErrors([
                'formError' => 'Произошла ошибка при сохранении пользователья'
            ]);
        }
    }

    public function registerOrganization(OrganizationRegisterRequest $request)
    {
        if(Auth::check()){
            return redirect(route('organization.main'));
        }
        if(User::where('email', $request->input('email'))->exists()){
            return redirect(route("user.regOrg"))->withErrors([
                'email'=>'Пользователь с таким email уже сушествует'
            ]);
        }

        $organization = new Organization();
        $organization->name = $request->input('orgName');
        $organization->sphere = $request->input('orgSphere');
        $organization->form = $request->input('orgForm');
        $organization->save();

        $user = new User();
        $user->name = $request->input('fullName');
        $user->role = 'organization';
        $user->phone = $request->input('phoneNumber');
        $user->region_id = $request->input('region');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->details = $organization->id;
        $saveTask = $user->save();
        //email
        // event(new Registered($user));
        if($saveTask){
            Auth::login($user);
            return redirect(route("main"));
        }else{
            return redirect(route('user.regOrg'))->withErrors([
                'formError' => 'Произошла ошибка при сохранении пользователья'
            ]);
        }
    }

    public function logoutUser(){
        Auth::logout();
        return redirect(route('user.login'));
    }

    public function login(StudentLoginRequest $request){
        if(Auth::check()){
            return redirect(route('main'));
        }else{
            if(Auth::attempt($request->validated())){
                return redirect()->intended(route('user.main'));
            }else{
                return redirect(route('user.login'))->withErrors([
                    'formError'=>'Неверный email или пароль'
                ]);
            }
        }
    }
}
