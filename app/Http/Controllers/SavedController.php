<?php

namespace App\Http\Controllers;

use App\Models\Saved;
use Illuminate\Http\Request;
use App\Models\User;


class SavedController extends Controller
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
        $saved = new Saved;

        $saved->user_id = auth()->user()->id;
        $saved->post_id = $request->input('post_id');
        $saved->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Saved $saved)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saved $saved)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saved $saved)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $saved = Saved::find($id);
        if ($saved) {
            $saved->delete();
        }
    }

    public function showSavedPosts($userId)
    {
        $user = User::find($userId);
        $savedPosts = $user->saveds()->get();
        
        return view('saved-posts', compact('savedPosts'));
    }
}
