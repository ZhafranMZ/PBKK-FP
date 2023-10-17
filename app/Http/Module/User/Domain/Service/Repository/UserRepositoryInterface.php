<?php

namespace App\Http\Module\User\Domain\Service\Repository;

use App\Http\Module\User\Domain\Model\User;

interface UserRepositoryInterface
{
    public function save(User $user);

}