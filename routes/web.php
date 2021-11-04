<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');


Route::get('/test', function () {
    //return "asfsadf";

    return response('411', 411);
})->name('test');


Route::middleware(['auth:sanctum','verified'])->get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::group([
    'prefix' => 'dashboard/admin',
    // 'namespace' => 'Mto',
    'middleware' => ['auth:sanctum','verified']],
    // 'middleware' => ['auth:sanctum','verified','role:admin']],
    function (){
        Route::middleware('password.confirm')->get('users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');

    }
);

