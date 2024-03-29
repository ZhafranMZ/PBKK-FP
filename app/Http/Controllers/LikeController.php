<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use App\Jobs\SendMailNotification;
use App\Models\User;
use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 'post_id' => 'required' ]);
        $like = new Like;

        $like->user_id = auth()->user()->id;
        // $user = User::find($like->user_id);
        $like->post_id = $request->input('post_id');
        $like->save();
        $post = Post::find($like->post_id);
        $user = User::find($post->user_id);
        $type = 'Received Like';
        dispatch(new SendMailNotification($user, $type));
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $like = Like::find($id);
        if ($like) {
            $like->delete();
        }
    }
}
