<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

class UsersController extends Controller
{
    public function index(){

        $users = User::permitidos()->paginate(10);

        //$users = User::all();

        return Inertia::render('Admin/Users/UsersIndex', [
            'paginator' => $users
        ]);
    }

    public function create(){

        $this->authorize('update', New User);

        return Inertia::render('Admin/Users/UserCreate');
    }

    public function store(UserStoreRequest $request, User $user)
    {

        $this->authorize('update', $user);

        $input = $request->validated();

        $input['username_umod'] = $request->user()->username;
        $input['password'] = Hash::make('password');

        $user = User::create($input);

        return Inertia::render('Admin/Users/UserEdit', [
            'usuario' => $user,
        ]);



    }

    public function edit(User $user){

        if ($user->id == 1 && !isRoot()){
            return abort(403, 'No dispones de los permisos necesarios');
        }

        return Inertia::render('Admin/Users/UserEdit', [
            'usuario' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {

        $this->authorize('update', $user);

        $input = $request->validated();

        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        //     'photo' => ['nullable', 'image', 'max:1024'],
        // ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $input['username_umod'] = auth()->user()->username;

        $user->update($input);

        //return response(['user'=>$user,'status'=>200]);
        return Inertia::render('Admin/Users/UserEdit', [
            'user' => $user
        ]);

        // if ($input['email'] !== $user->email &&
        //     $user instanceof MustVerifyEmail) {
        //     $this->updateVerifiedUser($user, $input);
        // } else {
        //     $user->forceFill([
        //         'name' => $input['name'],
        //         'email' => $input['email'],
        //     ])->save();
        // }
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
