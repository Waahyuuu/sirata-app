<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'mahasiswa' => \App\Http\Middleware\MahasiswaMiddleware::class,

            'stimata.auth' => \Stimata\Portal\Middleware\StimataAuth::class,
            'stimata.access' => \Stimata\Portal\Middleware\StimataCheckAccess::class,

            'protected.admin' => \App\Http\Middleware\EnsureProtectedAdmin::class,
        ]);
        $middleware->throttleApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $e->errors(),
                ], 422);
            }

            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden (Access denied)',
                ], 403);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => app()->environment('production')
                        ? 'Internal Server Error'
                        : $e->getMessage(),
                ], 500);
            }

            return null;
        });
    })->create();
