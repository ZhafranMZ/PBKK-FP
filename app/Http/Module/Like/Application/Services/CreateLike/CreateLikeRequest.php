<?php

namespace App\Http\Module\Like\Application\Services\CreateLike;

class CreateLikeRequest
{
    public function __construct(
        public int $user_id,
        public int $post_id
    )
    {
    }
}