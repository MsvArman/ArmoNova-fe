<?php

use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter;

function customExceptionHandler($e) {
    if ($e instanceof NotFoundHttpException) {
        http_response_code(404);
        header("Location: /404");
    } elseif ($e instanceof \App\Exceptions\AccessDeniedHttpException) {
        http_response_code(403);
        header("Location: /403");
    } else {
        http_response_code(500);
        header("Location: /500");
    }
    exit;
}

set_exception_handler('customExceptionHandler');

SimpleRouter::error(function($request, \Exception $exception) {
    if($exception instanceof NotFoundHttpException) {
        throw new NotFoundHttpException('Page not found.');
    }
    throw $exception;
});
