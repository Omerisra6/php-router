<?php
namespace App\Middlewares;

use App\Middlewares\Middleware;
use App\Utils\Response;

class MaintenanceModeMiddleware implements Middleware
{
    public function handle($data)
    {   
        if (APP_ENV === 'MAINTENANCE') 
        {
            return Response::make('Site under maintenance. Please try again later.', 503);
        }

        return $data;
    }
}