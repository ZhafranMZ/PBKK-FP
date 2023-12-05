<?php

namespace App\Http\Module\Like\Domain\Services\Repository;

use App\Http\Module\Like\Domain\Model\Like;

interface LikeRepositoryInterface
{
    public function store(Like $like);
    public function notifyUser(int $user_id, int $post_id);
}