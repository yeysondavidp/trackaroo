<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Acceder al proyecto por código en URL
Route::get('/project/{code}', [HomeController::class, 'index'])->name('project.home');
Route::get('/project/{code}/start', [HomeController::class, 'start'])->name('project.start');
Route::post('/project/{code}/start', [HomeController::class, 'insert'])->name('project.insert');
Route::post('/project/{code}/comments', [HomeController::class, 'comments'])->name('project.comments');
Route::post('/project/{code}/finish', [HomeController::class, 'finish'])->name('project.finish');
/*
Route::middleware(['role:technician'])->group(function () {
    Route::get('/project/{code}', [ProjectController::class, 'show']);
    Route::get('/project/{code}/start', [TrackingController::class, 'startForm']);
    Route::post('/project/{code}/start', [TrackingController::class, 'storeStart']);
});

Route::middleware(['role:supervisor|admin'])->group(function () {
    Route::get('/project/{code}/progress', [TrackingController::class, 'inProgress']);
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('/users', UserController::class);
});*/

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

    //Route::middleware(['role:supervisor|admin'])->group(function () {

        Route::get('/projects',[HomeController::class, 'list'])->name('project.list');
    //});
});
