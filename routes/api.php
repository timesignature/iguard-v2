<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(UserController::class)->group(function (){
    Route::post('/login','login');
    Route::post('/register','add');
});


Route::controller(EmployeeController::class)->group(function (){
    Route::post('/employees','add');
    Route::get('/employees','get');
});


Route::controller(SiteController::class)->group(function (){
    Route::post('/sites','add');
    Route::get('/sites','get');
});

Route::controller(CustomerController::class)->group(function (){
    Route::post('/clients','add');
    Route::get('/clients','get');
});
