<?php

namespace App\Http\Module\User\Domain\Infrastructure\Repository;

use App\Http\Module\User\Domain\Service\Repository\UserRepositoryInterface;

use App\Http\Module\User\Domain\Model\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user)
    {
        DB::table('user')->upsert(
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'profile_pic' => $user->profile_pic,
                'follower' => $user->follower,
                'following' => $user->following,
            ],'name'
        );
    }
}