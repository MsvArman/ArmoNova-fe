<?php

namespace Panel\Controllers;

class ErrorHandlerController
{

    public function NotFound() {

        return Public_view('public_pages/error/404_error');

    }
    
    public function Forbidden() {

        return Public_view('public_pages/error/403_error');

    }
    

    public function ServerError() {

        return Public_view('public_pages/error/500_error');

    }


}