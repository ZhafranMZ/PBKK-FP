<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $user = User::first(); 
        // dd($user->get());
        
        return view('profile')->with(['user'=>$user]);
    }
}