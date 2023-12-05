<?php

namespace App\Http\Module\Like\Presentation\Controller;

use App\Http\Module\Like\Application\Services\CreateLike\CreateLikeRequest;
use App\Http\Module\Like\Application\Services\CreateLike\CreateLikeService;
use Illuminate\Http\Request;

class LikeController
{
    public function __construct(
        private CreateLikeService $create_like_service
    )
    {
    }

    public function createLike(Request $request){
        // dd($request);

        $request = new CreateLikeRequest(
            auth()->user()->id,
            $request->input('post_id'),
        );

        return $this->create_like_service->execute($request);
    }
}