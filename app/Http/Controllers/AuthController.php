<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    const LOGIN_TRY = 10;

    /**
     * Display the login view.
     */
    public function register()
    {
        return view('auth.register');
    }
    /**
     * Display the login view.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function check(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $this->authenticate($request);

        $request->session()->regenerate();

//        $user = Auth::user();
        // null -> Pas co
        // User -> Co

        return to_route('home');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => 'required|string|email|unique:'.(new User())->getTable(),
            'password' => ['required', 'string'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('home');
    }

    protected function authenticate(Request $request): void
    {
        $rateKey = Str::transliterate($request->email.$request->ip());
        if (RateLimiter::tooManyAttempts($rateKey, self::LOGIN_TRY)) {
            $seconds = RateLimiter::availableIn($rateKey);

            throw ValidationException::withMessages([
                'email' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ]);
        }

        // Check login + password and log the user
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($rateKey);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($rateKey);
    }
}