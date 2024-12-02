<?php

namespace App\Http;

use App\Http\Middleware\LogRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \App\Http\Middleware\LogMiddleware::class,

    ];
    protected $middlewareGroups = [
        'web' => [
            // باقي الميدل وير...
            \App\Http\Middleware\LogMiddleware::class,
        ],
    ];
    

}
