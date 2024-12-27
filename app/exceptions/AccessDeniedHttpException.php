<?php
// File: app/exceptions/AccessDeniedHttpException.php
namespace App\Exceptions;

class AccessDeniedHttpException extends \Exception
{
    protected $message = 'Access Denied';
    protected $code = 403;
}
