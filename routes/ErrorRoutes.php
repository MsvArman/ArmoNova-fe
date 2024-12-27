<?php

namespace Route;

use Panel\Controllers\ErrorHandlerController;
use Pecee\SimpleRouter\SimpleRouter;

class ErrorRoutes
{
    public static function init(): void
    {
        SimpleRouter::get('/404', [ErrorHandlerController::class, 'NotFound']);
        SimpleRouter::get('/403', [ErrorHandlerController::class, 'Forbidden']);
        SimpleRouter::get('/500', [ErrorHandlerController::class, 'ServerError']);
    }
}