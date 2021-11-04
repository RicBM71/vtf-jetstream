<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(){

        $users = User::paginate(10);

        //$users = User::all();

        return Inertia::render('Admin/Users/UsersIndex', [
            'paginator' => $users
        ]);
    }

    public function edit(User $user){

        $users = User::paginate(10);

        //$users = User::all();

        return Inertia::render('Admin/Users/UserEdit', [
            'user' => $user
        ]);
    }
}
