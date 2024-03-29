<?php

namespace App\Http\Controllers;

use App\Http\Resources\AllPostsResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return Inertia::render('Home', [
            'posts' => new AllPostsResource($posts),
            'allUsers' => User::all()
        ]);
    }
}