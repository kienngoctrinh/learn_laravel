<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;

    public function __construct()
    {
        $this->model = User::query();

        $routeName = Route::currentRouteName();
        $arr       = explode('.', $routeName);
        $arr       = array_map('ucwords', $arr);
        $title     = implode(' - ', $arr);

        $roles = UserRoleEnum::getArrayView();

        View::share('title', $title);
        View::share('roles', $roles);
    }

    public function index()
    {
        $users = $this->model->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());

        $fileExtension = $request->file('avatar')->extension();
        $fileName      = uniqid() . time() . '.' . $fileExtension;
        $request->file('avatar')->storeAs('public/avatars', $fileName);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request, $userId)
    {
        $object = $this->model->find($userId);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        //
    }
}
