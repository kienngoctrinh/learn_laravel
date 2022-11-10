<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->firstOrFail();
            $checkExist = true;

            if (!Hash::check($request->get('password'), $user->password)) {
                throw new \Exception();
            }

            if (is_null($user)) {
                $user = new User();
                $user->role = UserRoleEnum::STUDENT;
                $checkExist = false;
            }

            if ($checkExist) {
                session()->put('name', $user->name);
                session()->put('role', $user->role);
                session()->put('avatar', $user->avatar);
                return redirect()->route('welcome');
            }

        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Login failed');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
