<?php

namespace App;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected function middleware(): array
    {
        return [
            \Illuminate\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \Illuminate\Http\Middleware\TrimStrings::class,
            \Illuminate\Http\Middleware\ConvertEmptyStringsToNull::class,
        ];
    }

    protected function middlewareGroups(): array
    {
        return [
            'web' => [
                \App\Http\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \App\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],

            'api' => [
                \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        ];
    }

    protected function routeMiddleware(): array
    {
        return [
            'auth' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class, // Tambahkan middleware admin di sini
        ];
    }
}
