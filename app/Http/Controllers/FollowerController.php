<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Jobs\SendMailNotification;
use App\Models\User;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = auth()->user();
        if(DB::table('followers')->where('following_id', $id)->where('follower_id', $user->id)->doesntExist()){
            return [
                'check' => false
            ];
        }else {
            return [
                'check' => true
            ];
        }
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
    public function store($id)
    {
        // dd($id);
        $user = auth()->user();
        $user_followed = User::find($id);
        // $follow_who = User::find($id);
        $type = 'Got a New Follower';
        dispatch(new SendMailNotification($user_followed, $type));
        if(DB::table('followers')->where('following_id', $id)->where('follower_id', $user->id)->doesntExist()){
            // dd($user);
            $user->follow()->attach($id);
            $user->save;
            // return redirect()->route('users.show',['id' => $id]);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function shownonfollower($id)
    {
        $followed = DB::table('followers')->select('following_id')->where('follower_id', $id)->get();
        $followedId = $followed->pluck('following_id')->toArray();
        $whoToFollow = DB::table('users')->whereNotIn('id', $followedId)->inRandomOrder()->limit(5)->get();
        // dd($whoToFollow);
        return [
            'data' => $whoToFollow,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $user = auth()->user();
        
        if(DB::table('followers')->where('following_id', $id)->where('follower_id', $user->id)->exists()){
            // dd($user);
            $user->follow()->detach($id);
            $user->save;
            // return redirect()->route('users.show',['id' => $id]);
        }     
    }
}
