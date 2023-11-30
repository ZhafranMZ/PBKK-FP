<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\AllPostsResource;
use App\Models\User;
use App\Models\Post;
use App\Services\FileManageService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    // public function index(){
    //     $user = User::first(); 
    //     // dd($user->get());
        
    //     return view('profile')->with(['user'=>$user]);
    // }

    public function show($id)
    {
        $user = User::find($id);
        if ($user === null) { return redirect()->route('home.index'); }

        $posts = Post::where('user_id', $id)->orderBy('created_at')->get();
        $follow = DB::table('followers')->where('follower_id', auth()->user()->id)->where('following_id', $id)->exists();

        return Inertia::render('User', [
            'user' => $user,
            'postsByUser' => new AllPostsResource($posts),
            'follow' => $follow,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([ 'file' => 'required|mimes:jpg,jpeg,png' ]);
        $user = (new FileManageService)->updateFile(auth()->user(), $request, 'user');
        $user->save();

        return redirect()->route('users.show',['id' => auth()->user()->id]);
    }
}