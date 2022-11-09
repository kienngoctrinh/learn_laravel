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
        DB::beginTransaction();
        try {
            $arr = $request->validated();
            $arr['password'] = Hash::make($arr['password']);

            if (!$request->hasFile('avatar')) {
                $arr['avatar'] = 'default.png';
            }

            if ($request->hasFile('avatar')) {
                $imageName = uniqid() . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('avatars'), $imageName);
                $arr['avatar'] = $imageName;
            }

            $this->model->create($arr);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request, $userId)
    {
        DB::beginTransaction();
        try {
            $arr = $request->validated();

            $user = $this->model->findOrFail($userId);

            if (!$request->hasFile('avatar')) {
                $arr['avatar'] = 'default.png';
            }

            if ($request->hasFile('avatar')) {
                $imageName = uniqid() . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('avatars'), $imageName);
                $arr['avatar'] = $imageName;
            }

            $user->update($arr);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
