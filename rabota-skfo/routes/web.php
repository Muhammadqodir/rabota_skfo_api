<?php

use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use App\Http\Middleware\Student;
use App\Jobs\SubscriptionNotifier;
use App\Models\Response;
use App\Models\Resume;
use App\Models\Student as ModelsStudent;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('main');
})->name("main");

Route::get('/companies', function () {
    return view('companies');
});

Route::get('/univercities', [UniversityController::class, 'getAllUniversitiesPage'])->name("univercities");

Route::name('user.')->group(function(){
    Route::get('/login', function(){
        if(Auth::check()){
            return redirect(route('profile'));
        }
        return view('login');
    })->name("login");;

    Route::get('/logout', [RegisterController::class, 'logoutUser'])->name("logout");
    Route::post('/login', [RegisterController::class, 'login'])->name('loginPost');

    Route::get('/reg', function (){
        if(Auth::check()){
            return redirect(route('profile'));
        }
        return view('st_reg');
    })->name("reg");
    Route::post('/regPost', [RegisterController::class, 'registerStudent'])->name("regPost");

    Route::post('/regOrg', [RegisterController::class, 'registerOrganization'])->name("regOrg");
    Route::get('/regOrg', function (){
        if(Auth::check()){
            return redirect(route('profile'));
        }
        return view('org_reg');
    })->name("regOrgPost");

    Route::get('student/resetPassword', [UserController::class, 'resetPassword'])->middleware('auth')->name('resetPassword');

    Route::get('/user', [ProfileController::class, 'profilePage'])->name("main");
});

Route::name('student.')->middleware('auth', 'student')->group(function(){
    Route::get('student/', function ()
    {
        return redirect(route('student.resume'));
    })->name('main');
    
    Route::get('student/resume', function (){
        return view('resume');
    })->name('resume');

    Route::get('student/createCV', function (){
        return view('create_resume');
    })->name('createCV');

    Route::post('student/updateProfile',  [ProfileController::class, 'updateStudentProfile'])->name('updateProfile');
    
    Route::get('student/profile', [StudentController::class, 'profilePage'])->name('profile');

    Route::get('student/views', function(){
        return view('st_stat');
    })->name('views');

    Route::get('student/favorites', function(){
        return view('st_favs');
    })->name('favorites');

    Route::get('student/addToFav', [StudentController::class, 'addToFav'])->name('addToFav');

    Route::get('student/subscribe', [StudentController::class, 'subscribe'])->name('subscribe');

    Route::get('student/subscriptions', function(){
        return view('st_subscriptions');
    })->name('subscriptions');

    Route::get('student/responds', [StudentController::class, 'respondsPage'])->name('responds');

    Route::get('resume/view', function(){
        return view('resumetemplate');
    })->name('view_resume');
    
    Route::get('resume/getPDF', [ResumeController::class, 'generatePDF'])->name('generate_pdf');
    
    Route::post('resume/create', [ResumeController::class, 'createResume'])->name('createResume');

});

Route::name('moderator.')->middleware('auth', 'moderator')->group(function(){
    Route::get('moderator/update_api_token', [ModeratorController::class, 'updateApiToken'])->name('updateApiToken');

    Route::get('moderator/profile', [ModeratorController::class, 'profilePage'])->name('profile');
    
    Route::get('moderator/stat', [ModeratorController::class, 'staticticsPage'])->name('stat');

    Route::get('moderator/students', [ModeratorController::class, 'studentsPage'])->name('students');

    Route::get('moderator/univers', [ModeratorController::class, 'universPage'])->name('univers');

    Route::get('moderator/employers', [ModeratorController::class, 'employersPage'])->name('employers');

    Route::get('moderator/vacancies', [ModeratorController::class, 'vacanciesPage'])->name('vacancies');
    
    Route::get('moderator/vacancies?org={org}', [ModeratorController::class, 'vacanciesPage'])->name('orgVacancies');

    Route::get('moderator/vacancy/setActive', [VacancyController::class, 'setIsActive'])->name('setVacancyIsActive');

    Route::get('moderator/org/setOrgActive', [OrganizationController::class, 'setActiveState'])->name('setOrgActive');

    Route::get('moderator/org/removeOrg', [OrganizationController::class, 'removeOrg'])->name('removeOrg');

    Route::get('moderator/vacancy/removeVacancy', [VacancyController::class, 'removeVacancy'])->name('removeVacancy');

    Route::get('moderator/studentsToExcel', [ExportExcelController::class, 'studentsToExcelAll'])->name('studentsToExcel');

    Route::get('moderator/removeStudent/{id}', [ModeratorController::class, 'removeStudent'])->name('removeStudent');

    Route::get('moderator/editResume/{id}', [ModeratorController::class, 'editResume'])->name('editResume');

    Route::post('moderator/editResume', [ModeratorController::class, 'saveResume'])->name('editResumePost');

    Route::get('moderator/editProfile/{id}', [ModeratorController::class, 'editProfile'])->name('editProfile');

    Route::post('moderator/updateStudentProfile/',  [ModeratorController::class, 'updateStudentProfile'])->name('updateStudentProfile');

    Route::post('moderator/updateUniverProfile/',  [ModeratorController::class, 'updateUniverProfile'])->name('updateUniverProfile');

    Route::post('moderator/import/students', [ImportController::class, 'importStudentsMD'])->name('importStudents');
});

Route::name('univer.')->middleware('auth', 'university')->group(function(){

    Route::get('university/profile', [UniversityController::class, 'profilePage'])->name('profile');

    Route::post('university/updateProfile', [ProfileController::class, 'updateUniverProfile'])->name('updateProfile');

    Route::get('university/students', [UniversityController::class, 'studentsPage'])->name('students');

    Route::get('university/stat', [UniversityController::class, 'staticticsPage'])->name('stat');
    
    Route::get('university/editResume/{id}', [UniversityController::class, 'editResume'])->name('editResume');

    Route::post('university/editResume', [UniversityController::class, 'saveResume'])->name('editResumePost');

    Route::get('university/editProfile/{id}', [UniversityController::class, 'editProfile'])->name('editProfile');

    Route::post('university/updateStudentProfile/',  [UniversityController::class, 'updateStudentProfile'])->name('updateStudentProfile');

    Route::get('university/removeStudent/{id}', [UniversityController::class, 'removeStudent'])->name('removeStudent');

    Route::get('university/studentsToExcel', [ExportExcelController::class, 'studentsToExcel'])->name('studentsToExcel');

    Route::post('import/students', [ImportController::class, 'importStudents'])->name('importStudents');
});

Route::name('org.')->middleware('auth', 'organization')->group(function(){

    Route::get('org/', function ()
    {
        return redirect(route('org.vacancies'));
    })->name('main');

    Route::get('org/vacancies', function(){
        return view('org_vacancies');
    })->name('vacancies');

    Route::get('org/favorites', function(){
        return view('org_favs');
    })->name('favorites');

    Route::get('org/createVacancy', function(){
        return view('create_vacancy');
    })->name('createVacancy');

    Route::get('org/addToFav', [OrganizationController::class, 'addToFav'])->name('addToFav');

    Route::get('org/editVacancy/{id}', [VacancyController::class, 'editVacancy'])->name('editVacancy');

    Route::get('org/vacancy/setIsActive', [VacancyController::class, 'setIsActive'])->name('setVacancyIsActive');

    Route::get('org/vacancy/removeVacancy', [VacancyController::class, 'removeVacancy'])->name('removeVacancy');

    Route::get('org/guests', function(){
        return view("org_guests");
    })->name('guests');

    Route::get('org/profile', [OrganizationController::class, 'profilePage'])->name('profile');

    Route::post('org/updateProfile',  [ProfileController::class, 'updateOrganizationProfile'])->name('updateProfile');
    
    Route::post('org/createVacancy/Post', [VacancyController::class, 'createVacancy'])->name('createVacancyPost');

});

Route::get('profile/', [ProfileController::class, 'profilePage'])->name('profile')->middleware('auth');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(route('main'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('ev_message', 'Письмо для подтверждение почты отправлено повторно!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/crop', 'App\Http\Controllers\CropImageController@uploadCropImage')->name('crop');

Route::get('university/getByRegion', [UniversityController::class, 'getUniversitiesByRegion'])->name('getUniverByRegion');

Route::get('resume/public/{resume_id}', [ResumeController::class, 'getPublicResume'])->name("public_resume");
Route::get('resume/newView', [ResumeController::class, 'newView'])->middleware('auth')->name("viewResume");
Route::get('resume/getContacts', [ResumeController::class, 'getContacts'])->middleware('auth')->name("rGetContacts");
Route::get('resume/newResponse', [ResumeController::class, 'newResponse'])->middleware('auth', 'organization')->name("rResponse");
Route::get('vacancy/getContacts', [VacancyController::class, 'getContacts'])->middleware('auth')->name("vGetContacts");
Route::get('org/{id}', [OrganizationController::class, 'getDetails'])->name('orgDetails');
Route::get('vacancy/{id}', [VacancyController::class, 'vacancyDetails'])->name('vacancyDetails');

Route::get('resume/{resume_id}', [ResumeController::class, 'openResumePage'])->name("open_resume");

Route::get('search', [SearchController::class, 'search'])->name('search');

Route::get('test', function(){
    return Hash::make('testpassword');
})->name('test');
