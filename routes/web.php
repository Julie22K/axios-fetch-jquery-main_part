<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/fetch', function () {return view('fetch.index');});

Route::get('/jquery', function () {return view('jquery.index');});


Route::get('/students',[StudentController::class,'index']);
Route::post('/student',[StudentController::class,'store']);