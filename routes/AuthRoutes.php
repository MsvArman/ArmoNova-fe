<?php

namespace Route;
use Panel\Controllers\AuthController;
use Pecee\SimpleRouter\SimpleRouter;


class AuthRoutes
{
    public static function init(): void
    {
        SimpleRouter::get('/login', [AuthController::class, 'login']);
        SimpleRouter::get('/register', [AuthController::class, 'register']);
        SimpleRouter::get('/verify-otp', [AuthController::class, 'verifyotp']);
        SimpleRouter::get('/logout', [AuthController::class, 'logout']);
        SimpleRouter::post('/set-session-login', [AuthController::class, 'setSession']);
        SimpleRouter::get('/forget-password', [AuthController::class, 'forgetPassword']);
        SimpleRouter::get('/new-password', [AuthController::class, 'newPassword']);

    }
}