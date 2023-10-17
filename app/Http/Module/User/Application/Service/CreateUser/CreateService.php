<?php

namespace App\Http\Module\User\Application\Services\CreateProduct;

class CreateService
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $profile_pic,
        public int $follower,
        public int $following
    )
    {
    }
}