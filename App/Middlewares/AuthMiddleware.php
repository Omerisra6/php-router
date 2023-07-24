<?php
namespace App\Middlewares;

use App\Middlewares\Middleware;
use App\Utils\Response;

class AuthMiddleware implements Middleware
{
    public function handle($data)
    {
        if (! isset($_SESSION['id'])) 
        {
            Response::make(401, 'Unauthorized')->send();
        }

        return $data;
    }
}