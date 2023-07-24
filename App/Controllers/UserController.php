<?php
namespace App\Controllers;

use App\Services\ProfileService;
use App\Utils\HtmlResponse;
use App\Utils\Response;

class UserController
{
    public function profile($request)
    {
        if (! isset($request[ 'profile' ])) 
        {
            return Response::make(404, 'Profile not found');
        }

        $profileId = $request[ 'profile' ];
        $user      = ProfileService::get($profileId);
        if (isset($user->error))
        {
            return Response::make(404, 'Profile not found');
        }
    
        return HtmlResponse::make('profile', [ 'user' => $user ]);
    }

    public function store($request)
    {
        return Response::make(200, 'stored');
    }
}