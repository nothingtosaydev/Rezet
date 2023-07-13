<?php

namespace Modules\User\Repositories;

use Modules\User\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param  string  $id
     * @return \Modules\User\User|null
     */
    public function findByGoogle(string $id, string $email): ?User
    {
        return User::where('google_id', $id)->orWhere('email', $email)->first();
    }

    /**
     * @param  array  $data
     * @return \Modules\User\User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }
}
