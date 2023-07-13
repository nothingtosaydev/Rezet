<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Modules\User\Repositories\UserRepositoryInterface;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param  \Modules\User\Repositories\UserRepositoryInterface  $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param  \App\Http\Controllers\Auth\Requests\LoginRequest  $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return redirect('home')->withSuccess('You have Successfully logged in');
        }

        return redirect('login')->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
