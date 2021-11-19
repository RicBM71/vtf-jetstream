<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
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
    dd(config('app.env'));
    //return auth()->user()->getAllPermissions()->pluck('name');
    /** @var \App\Models\User */
    $user = auth()->user();
    return $user->getRoleNames();
    return Auth::user();

})->name('test');


Route::middleware(['auth:sanctum','verified'])->get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


Route::group([
    'prefix' => 'admin',
    // 'namespace' => 'Mto',
    //'middleware' => ['auth:sanctum','verified','password.confirm']],
    'middleware' => ['auth:sanctum','verified','role:root']],
    function (){


        //Route::middleware('password.confirm')->resource('users', App\Http\Controllers\Admin\UsersController::class);
        Route::resource('users', App\Http\Controllers\Admin\UsersController::class);
        Route::delete('users/{user}/photo/delete', [App\Http\Controllers\Admin\UsersPhotoController::class, 'destroy'])->name('photo.destroy');

        Route::get('users/{user}/roles', [App\Http\Controllers\Admin\UsersRolesController::class, 'show']);
        Route::put('users/{user}/roles', [App\Http\Controllers\Admin\UsersRolesController::class, 'update'])->name('user.roles.update');
        Route::get('users/{user}/permission', [App\Http\Controllers\Admin\UsersPermissionsController::class, 'show']);
        Route::put('users/{user}/permission', [App\Http\Controllers\Admin\UsersPermissionsController::class, 'update']);

        Route::resource('roles', App\Http\Controllers\Admin\RolesController::class);

    }
);

