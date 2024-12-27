<?php
// File: app/exceptions/NotFoundHttpException.php
namespace App\Exceptions;

class NotFoundHttpException extends \Exception
{
    protected $message = 'Page Not Found';
    protected $code = 404;
}