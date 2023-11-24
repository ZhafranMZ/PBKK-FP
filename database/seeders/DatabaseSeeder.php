<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Feed;
// use App\Models\Feed;
// use App\Models\Story;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $UserCount = 100;   //Jumlah User
        $MaxPostCount = 10; //Maksimal Jumlah Post
        $MaxLikeCount = 100;    //Maksimal Jumlah Like
        $MaxCommentCount = 100; //Maksimal Jumlah Comment

        //Jalankan factory untuk User dengan jumlah sesuai dengan $UserCount
        User::factory($UserCount)->create()->each(function($user) use ($UserCount, $MaxPostCount, $MaxLikeCount, $MaxCommentCount){
            $PostRand = Rand(1, $MaxPostCount); //Random untuk menentukan jumlah Post masing2 User

            //Jalankan factory untuk Post dengan jumlah sesuai dengan $PostRand
            Post::factory($PostRand)->create(['user_id' => $user->id])->each(function($post) use ($user, $UserCount, $MaxLikeCount, $MaxCommentCount) {
                $LikeRand = Rand(1,$MaxLikeCount);  //Random untuk menentukan jumlah Like masing2 User
                $CommentRand = Rand(1,$MaxCommentCount);    //Random untuk menentukan jumlah Comment masing2 User

                //Buat array angka dengan range 1 sampai jumlah User di $UserCount lalu shuffle
                $shuffledUserIdsLike = range(1, $UserCount);
                shuffle($shuffledUserIdsLike);

                //Lakukan looping dengan jumlah sebanyak $LikeRand yang di dalamnya berisi factory untuk Like dengan user_id sesuai dengan Array $shuffledUserIdsLike yang sudah shuffle
                //Menggunakan Array dikarenakan satu User tidak boleh Like Post yang sama lebih dari sekali
                for($i=0;$i<$LikeRand;$i++){
                    Like::factory(1)->create([
                        'user_id' => $shuffledUserIdsLike[$i],
                        'post_id' => $post->id
                    ]);
                }

                //Lakukan looping dengan jumlah sebanyak $LikeRand yang di dalamnya berisi factory untuk Like dengan user_id random
                //Menggunakan random dan tidak menggunakan array dikarenakan satu User bisa Comment berkali-kali di Post yang sama
                for($i=0;$i<$CommentRand;$i++){
                    Comment::factory(1)->create([
                        'user_id' => Rand(1, $UserCount),
                        'post_id' => $post->id
                    ]);
                }
            });
        });
    }
}
