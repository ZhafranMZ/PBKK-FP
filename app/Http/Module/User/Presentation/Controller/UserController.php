<?php

namespace App\Http\Module\User\Presentation\Controller;

use App\Http\Module\User\Application\Services\CreateProduct\CreateProductRequest;
use App\Http\Module\User\Application\Services\CreateProduct\CreateService;
use App\Http\Module\User\Application\Services\CreateUser\CreateRequest;
use Illuminate\Http\Request;

class UserController
{
    public function __construct(
        private CreateRequest $create_request
    )
    {
    }

    public function createUser(Request $request){
        // dd($request);
        $request = new CreateService(
             $request -> input('name'),
             $request -> input('email') ,
             $request -> input('password') ,
             $request -> input('profile_pic') ,
             $request -> input('follower') ,
             $request -> input('following') 
        );

        return $this->create_request->execute($request);
    }
}