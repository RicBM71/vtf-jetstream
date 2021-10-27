<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(){

        $users = User::all();

        return Inertia::render('Admin/Users/UsersIndex', [
            'users' => $users
        ]);
    }
}
