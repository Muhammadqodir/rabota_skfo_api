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

Route::get('statistics', );

Route::get('university/getAll', [UniversityController::class, 'getUniversities']);

Route::get('university/all', [ApiController::class, 'getUnivers']);

Route::get('university/getByRegion', [UniversityController::class, 'getUniversitiesByRegion'])->name('api.getUniverByRegion');

Route::get('statistics/', [ApiTest::class, 'getStat']);
