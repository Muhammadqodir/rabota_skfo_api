<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");
    
        Mail::send('mail.test', $data, function($message) {
        $message->to('m.qodir777@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
        $message->from('no-reply@rabota-skfo.ru','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public static function newResponse(Response $response, User $r_user, $auth_use_id) {
        if($response->getTarget()->isResponsed($auth_use_id)){
            $data = array('respond'=> $response);
            Mail::send('mail.new_respond', $data, function($message) use ($r_user, $response) {
                $message->to($r_user->email, $r_user->name)->subject
                    ("Вас приглашает на работу ".$response->getUser()->getDetails()->getOrgFullName());
                $message->from('no-reply@rabota-skfo.ru', 'РаботаСКФО');
            });
        }
    }

    public static function notifyNewVacancy($to_list, $vacancy_id) {
        $vacancy = Vacancy::find($vacancy_id);
        info('vacancy', ['vacancy' => $vacancy]);
        if($vacancy != null){
            $data = array('vacancy'=> $vacancy);
            info("email",['email'=>$to_list]);
            Mail::send('mail.new_vacancy', $data, function($message) use ($to_list, $vacancy) {
                $message->to($to_list)->subject
                    ("Новая вакансия от компании ".$vacancy->getUser()->getDetails()->getOrgFullName());
                $message->from('no-reply@rabota-skfo.ru', 'РаботаСКФО');
            });
        }
    }

}
