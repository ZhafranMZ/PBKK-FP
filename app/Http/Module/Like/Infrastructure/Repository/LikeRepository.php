<?php

namespace App\Http\Module\Like\Infrastructure\Repository;

use App\Models\User;
use App\Models\Post;
use App\Jobs\SendMailNotification;
use App\Http\Module\Like\Domain\Model\Like;
use App\Http\Module\Like\Domain\Services\Repository\LikeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LikeRepository implements LikeRepositoryInterface
{
    public function store(Like $like)
    {
        DB::table('likes')->upsert(
            [
                'user_id' => $like->user_id,
                'post_id' => $like->post_id,
            ], ['user_id', 'post_id']
        );
    }

    public function notifyUser(int $user_id, int $post_id){
        $post = Post::find($post_id);
        $user = User::find($user_id);
        $type = 'Received Like';
        dispatch(new SendMailNotification($user, $type));
    }
}