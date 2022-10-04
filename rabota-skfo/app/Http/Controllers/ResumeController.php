<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Download;
use App\Models\Response;
use App\Models\Resume;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function createResume(ResumeRequest $request){

        if(!Auth::check()){
            abort(403, 'Unauthorized action.');
        }
        
        $resume = new Resume();
        if(Resume::where('user_id', Auth::user()->id)->count() > 0){
            $resume = Resume::where('user_id', Auth::user()->id)->get()[0];
        }

        $resume->user_id = Auth::user()->id;
        $resume->citizenship = $request->citizenship;
        $resume->alt_contact = $request->alt_contact;
        $resume->position = $request->position;
        $resume->salary = intval($request->salary);
        $resume->salary_by_agreement = $request->salary_by_agreement == "true" ? true: false;;
        $resume->b_trip = $request->b_trip == "true" ? true: false;
        $resume->moving = $request->moving == "true" ? true: false;;
        $resume->employment_type = $request->employment_type;
        $resume->education = $request->education;
        $resume->experience = $request->experience;
        $resume->langs = $request->langs;
        $resume->skills = $request->skills;
        $resume->driver_license = $request->driver_license;
        $resume->achievements = $request->achievements;
        $resume->family_status = $request->family_status;
        $resume->interests = is_null($request->interests) ? "": $request->interests;
        $resume->additional_info = is_null($request->additional_info) ? "": $request->additional_info;
        $saveTask = $resume->save();

        return $saveTask;
    }

    public function generatePDF(){
        $pdf = App::make('dompdf.wrapper');
        $pdf->load_html_file(public_path()."/test_resume.html");
        return "ok";
    }

    public function openResumePage($resume_id){
        $resume = Resume::find($resume_id);
        if($resume != null){
            $resume->newView();
            return view('resume_details', ["resume"=>$resume]);
        }else{
            return view('errors.404');
        }
        // dd($resume_id);
    }

    public function getPublicResume(Request $request, $resume_id){
        $resume = Resume::find($resume_id);
        if($resume != null){
            if($request->has("download")){
                $resume->download();
            }
            $resume->newView();
            return view('public_resume', ["resume"=>$resume, "user"=>$resume->getUser()]);
        }else{
            return view('errors.404');
        }
    }

    public function newView(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if($request->has('resume_id')){
                $resume = Resume::find($request->resume_id);
                if($resume != null){
                    $resume->newView();
                    return json_encode([
                        "success"=>true,
                        "message"=>"ok"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "message"=>"Invalid resume_id"
                    ]);
                }
            }else{
                abort(400, "Bad Request");
            }
        }else{
            abort(403, 'Unauthorized action.');
        }

    }

    public function getContacts(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if($request->has('resume_id')){
                $resume = Resume::find($request->resume_id);
                if($resume != null){
                    $resume->contactRequest();
                    return json_encode([
                        "success"=>true,
                        "message"=>"ok"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "message"=>"Invalid resume_id"
                    ]);
                }
            }else{
                abort(400, "Bad Request");
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
    }

    public function newResponse(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            if($request->has('resume_id') && $request->has('msg')){
                $resume = Resume::find($request->resume_id);
                if($resume != null){
                    $resume->newResponse($request->msg);
                    return json_encode([
                        "success"=>true,
                        "message"=>"ok"
                    ]);
                }else{
                    return json_encode([
                        "success"=>false,
                        "message"=>"Invalid resume_id"
                    ]);
                }
            }else{
                abort(400, "Bad Request");
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
    }


}
