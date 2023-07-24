<?php
namespace App\Middlewares;

use App\Middlewares\Middleware;

class LogMiddleware implements Middleware
{
    public function handle($data)
    {
        error_log('error');

        return $data;
    }
}