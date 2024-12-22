<?php

use App\Http\Middleware\KhususMiddleware;
use App\Http\Middleware\KhususPengguna;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // 'khususUser' => KhususPengguna::class,
            // 'khususMiddleware' => KhususMiddleware::class
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class
        ]);
        $middleware->validateCsrfTokens(except: [
            'payment/midtrans-callback',
         ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
