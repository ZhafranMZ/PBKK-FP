<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $request->validate([ 
            'post_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        $comment = new Comment;

        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->comment = $request->input('comment');
        $comment->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
        }
    }
}