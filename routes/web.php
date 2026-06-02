<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// GETS
Route::get('/login', [AuthController::class, 'showLogin']) -> name('login');
Route::get('/register', [AuthController::class, 'showRegister']) -> name('register');
Route::get('/home', [ProjController::class, 'projecttable'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'showdashboard']);
Route::get('/perdashboard', [AuthController::class, 'showperdashboard'])->name('perdashboard');
    //user
Route::get('/deleteuser/{id}', [AuthController::class, 'deleteuser']);
    //proj
Route::get('/deleteproj/{id}', [ProjController::class, 'deleteproj']);

// POSTS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
    //user
Route::post('/adduser', [AuthController::class, 'register']);
Route::post('/edituser/{id}', [AuthController::class, 'edituser']);
Route::post('/editpersonaluser/{id}', [AuthController::class, 'editpersonaluser']);
Route::post('/updateprofilepicture/{id}', [AuthController::class, 'updateProfilePicture']);
    //project
Route::post('/addproj', [ProjController::class, 'addproj']);
Route::post('/editproj/{id}', [ProjController::class, 'editproj']);
