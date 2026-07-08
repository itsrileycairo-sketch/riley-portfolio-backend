<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
 ->withMiddleware(function (Middleware $middleware) {
    $middleware->statefulApi();
    $middleware->validateCsrfTokens(except: [
        'api/*',
    ]);
    
    // TAMBAHKAN BARIS INI UNTUK MEMBUKA PINTU CORS:
    $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
})

    })->create();
