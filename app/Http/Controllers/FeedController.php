<?php

namespace App\Http\Controllers;

use App\Models\Feed;

class FeedController extends Controller
{
    //
    public function index(){
        $feed = Feed::All(); 
        dd($feed);
    }
}
