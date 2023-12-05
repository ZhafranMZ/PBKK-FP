<?php

namespace App\Http\Module\Like\Application\Services\CreateLike;

use App\Http\Module\Like\Domain\Model\Like;
use App\Http\Module\Like\Infrastructure\Repository\LikeRepository;

class CreateLikeService
{

    public function __construct(
        private LikeRepository $like_repository
    )
    {
    }

    public function execute(CreateLikeRequest $request){
        $like = new Like(
            $request->user_id,
            $request->post_id,
        );

        $this->like_repository->store($like);
        $this->like_repository->notifyUser($request->user_id, $request->post_id);
    }
}