<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
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

        return Inertia::render('Admin/Users/UserEdit', [
            'user' => $user
        ]);
    }

    public function destroy(User $user){

        $this->authorize('delete', $user);

        $user->delete();

        // $users = User::paginate(10);

        // return Inertia::render('Admin/Users/UsersIndex', [
        //     'paginator' => $users
        // ]);

        //return Inertia::location(route('users.index'));

        return response(['message'=>'Usuario Borrado','status'=>200]);

    }
}
