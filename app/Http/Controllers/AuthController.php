<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function __construct()
    {
        $roles = UserRoleEnum::getArrayView();

        View::share('roles', $roles);
    }

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

            if (!Hash::check($request->get('password'), $user->password)) {
                throw new \Exception();
            }

            session()->put('name', $user->name);
            session()->put('role', $user->role);
            session()->put('avatar', $user->avatar);

            return redirect()->route('welcome');
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Login failed');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function callback($provider)
    {
        $data = Socialite::driver($provider)->user();

        $user = User::query()
            ->firstOrCreate([
                'email' => $data->getEmail(),
            ], [
                'name' => $data->getName(),
                'role' => UserRoleEnum::STUDENT,
            ]);

        Auth::login($user);

        return redirect()->route('register');
    }

    public function registering(Request $request)
    {
        $password = Hash::make($request->get('password'));

        if (auth()->check()) {
            User::query()
                ->where('id', auth()->user()->id)
                ->update([
                    'password' => $password,
                ]);
        } else {
            $user = User::query()
                ->create([
                    'name'     => $request->get('name'),
                    'email'    => $request->get('email'),
                    'role'     => UserRoleEnum::STUDENT,
                    'password' => $password,
                ]);

            Auth::login($user);
        }

        return redirect()->route('welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
