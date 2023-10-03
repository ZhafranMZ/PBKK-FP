<?php

namespace App\Http\Controllers;

use App\Models\Story;

class StoryController extends Controller
{
    //
    public function index(){
        $story = Story::All(); 
        dd($story);
    }
}