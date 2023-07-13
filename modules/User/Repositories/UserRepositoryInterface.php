<?php

namespace Modules\User\Repositories;

use Modules\User\User;

interface UserRepositoryInterface
{
    public function findByGoogle(string $id, string $email): ?User;

    public function create(array $data): User;
}
