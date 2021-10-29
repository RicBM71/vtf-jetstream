<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Admin\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//Route::middleware(['auth:sanctum','verified','password.confirm','role:admin',])->get('users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');


Route::group([
    'prefix' => 'dashboard/admin',
    // 'namespace' => 'Mto',
    'middleware' => ['auth:sanctum','verified','role:admin']],
    function (){

        //Route::get('users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
        Route::middleware('password.confirm')->get('users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
        //Route::resource('facultativos', App\Http\Controllers\Mto\FacultativosController::class);
    }
);

