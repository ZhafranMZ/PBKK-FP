<?php

namespace App\Http\Module\User\Application\Services\CreateUser;

use App\Http\Module\User\Application\Services\CreateProduct\CreateService;
use App\Http\Module\User\Domain\Model\User;
use App\Http\Module\User\Domain\Infrastructure\Repository\UserRepository;

class CreateRequest
{

    public function __construct(
        private UserRepository $user_repository
    )
    {
    }

    public function execute(CreateService $users){
        $user = new User(
                $users->name,
                $users->email,
                $users->password,
                $users->profile_pic,
                $users->follower,
                $users->following,
        );

        $this->user_repository->save($user);
    }
}