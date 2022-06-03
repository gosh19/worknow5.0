<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('courses/get-all/{withSelected?}', [\App\Http\Controllers\Api\CoursesData::class ,'getAll']);
Route::get('courses/get-selected', [\App\Http\Controllers\Api\CoursesData::class ,'getSelectedInSession']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
