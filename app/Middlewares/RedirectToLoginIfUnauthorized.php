<?php

namespace Panel\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class RedirectToLoginIfUnauthorized implements IMiddleware
{
    public function handle(Request $request): void
    {
        // if (!isset($_COOKIE['accessToken'])) {

        //     redirect(url('/login'));
        //     die();
        // }
    }
}