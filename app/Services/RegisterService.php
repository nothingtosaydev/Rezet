<?php

namespace App\Services;

use Modules\User\Repositories\UserRepositoryInterface;
use Modules\User\User;

class RegisterService
{
    /**
     * @param  \Modules\User\Repositories\UserRepositoryInterface  $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @param  array  $payload
     * @return \Modules\User\User
     */
    public function register(array $payload): User
    {
        return $this->userRepository->create($payload);
    }
}
