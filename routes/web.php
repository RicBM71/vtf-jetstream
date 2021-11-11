<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
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
    //return auth()->user()->getAllPermissions()->pluck('name');
    /** @var \App\Models\User */
    $user = auth()->user();
    return $user->getRoleNames();
    return Auth::user();

})->name('test');


Route::middleware(['auth:sanctum','verified'])->get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::group([
    'prefix' => 'dashboard/admin',
    // 'namespace' => 'Mto',
    'middleware' => ['auth:sanctum','verified']],
    // 'middleware' => ['auth:sanctum','verified','role:admin']],
    function (){

        //Route::middleware('password.confirm')->get('users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
        Route::middleware('password.confirm')->resource('users', App\Http\Controllers\Admin\UsersController::class);
        Route::middleware('password.confirm')->delete('users/{user}/photo/delete', [App\Http\Controllers\Admin\UsersPhotoController::class, 'destroy'])->name('photo.destroy');

    }
);

