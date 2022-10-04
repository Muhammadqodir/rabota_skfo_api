<?php

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Api\ApiTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getUniverByRegion', [UniversityController::class, 'getUniversitiesByRegion'])->name('api.getUniverByRegion');

Route::get('statistics', [ApiController::class, 'getStat']);

Route::post('statistics/byRegion', [ApiController::class, 'getStatByRegion']);

Route::get('regions', [ApiController::class, 'getRegions']);

Route::get('university/getAll', [ApiController::class, 'getUnivers']);

Route::post('university/byRegion', [ApiController::class, 'getUniversByRegion']);

Route::get('university/{id}', [ApiController::class, 'getUniver']);

Route::get('university/{id}/getStudents', [ApiController::class, 'getUniverStudents']);

Route::get('student/getAll', [ApiController::class, 'getStudents']);

Route::get('student/{id}', [ApiController::class, 'getStudent']);

Route::get('student/{id}/getResume', [ApiController::class, 'getStudentResume']);

Route::post('student/byRegion', [ApiController::class, 'getStudentsByRegion']);

Route::post('student/byUniversity', [ApiController::class, 'getStudentsByUniver']);

Route::get('organization/getAll', [ApiController::class, 'getOrgs']);

Route::get('organization/{id}', [ApiController::class, 'getOrg']);

Route::post('organization/byRegion', [ApiController::class, 'getOrgsByRegion']);

Route::get('organization/{id}/getVacancies', [ApiController::class, 'getOrgVacancies']);


Route::get('vacancy/getAll', [ApiController::class, 'getVacancies']);

Route::get('vacancy/search', [ApiController::class, 'searchVacancy']);

Route::get('vacancy/{id}', [ApiController::class, 'getVacancy']);


Route::get('resume/getAll', [ApiController::class, 'getResumes']);

Route::get('resume/search', [ApiController::class, 'searchResume']);

Route::get('resume/{id}', [ApiController::class, 'getResume']);
