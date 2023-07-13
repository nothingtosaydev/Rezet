<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Services\RegisterService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Enums\Status;
use Modules\User\Repositories\UserRepositoryInterface;

class RegisterController extends Controller
{
    use RegistersUsers; // ??

    /**
     * @param  \App\Services\RegisterService  $registerService
     */
    public function __construct(
        protected RegisterService $registerService
    ) {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->registerService->register([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => Status::Active->value
        ]);

        Auth::login($user);

        return redirect('/home')->withSuccess('Great! You have Successfully logged in');
    }
}
