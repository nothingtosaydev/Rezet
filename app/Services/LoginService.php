<?php

namespace App\Services;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Modules\User\Enums\Status;
use Modules\User\Repositories\UserRepositoryInterface;
use Modules\User\User;

class LoginService
{
    /**
     * @param  \Modules\User\Repositories\UserRepositoryInterface  $userRepository
     * @param  \App\Services\RegisterService  $registerService
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected RegisterService $registerService
    ) {
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Modules\User\User
     */
    public function login(Request $request): User
    {
        $googleUser = Socialite::driver('google')->user();

        if (!$user = $this->userRepository->findByGoogle($googleUser->id, $googleUser->email)) {
            $user = $this->registerService->register([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'profile' => $googleUser->avatar,
                'google_id' => $googleUser->id,
                'status' => Status::Active->value,
                'password' => encrypt('NnPWYJn1D22w')
            ]);
        }

        return $user;
    }
}
