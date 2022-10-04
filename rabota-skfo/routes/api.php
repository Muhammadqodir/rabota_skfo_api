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
