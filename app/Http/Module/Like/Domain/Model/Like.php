<?php

namespace App\Http\Module\Like\Domain\Model;

class Like
{
    /**
     * @param int $user_id
     * @param float $post_id
     */
    public function __construct(
        public int $user_id,
        public int $post_id
    )
    {

    }
}