<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $search = $request->get('q');

        $users = $this->model
            ->where('email', 'like', '%' . $search . '%')
            ->orWhere('code', $search)
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orderBy('name', 'asc')
            ->get();

        return view('users.index', [
            'users' => $users,
            'search' => $search,
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

            if ($request->hasFile('avatar')) {
                $imageName = uniqid() . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('avatars'), $imageName);
                $arr['avatar'] = $imageName;
            }

            $arr['password'] = Hash::make($arr['password']);

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

    public function destroy($userId)
    {
        User::destroy($userId);

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
