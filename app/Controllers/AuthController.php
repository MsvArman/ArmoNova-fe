<?php

namespace Panel\Controllers;

class AuthController
{
    public function register()
    {
        return Public_view('public_pages/auth/register');
    }

    public function verifyotp()
    {
        return Public_view('public_pages/auth/otpCode');
    }

    public function login()
    {
        return Public_view('public_pages/auth/login');
    }

    public function forgetPassword()
    {
        return Public_view('public_pages/auth/forgetPassword');
    }

    public function newPassword()
    {
        return Public_view('public_pages/auth/newPassword');
    }


    public function setSession() {
        // $input = file_get_contents('php://input');
        // $data = json_decode($input, true);
    
        // if (json_last_error() !== JSON_ERROR_NONE) {
        //     http_response_code(400);
        //     echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
        //     exit;
        // }
    
        // // Check if all required data is present
        // if (!isset($data['accessToken'], $data['expiresIn'], $data['role_id'], $data['user_id'])) {
        //     http_response_code(400);
        //     echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        //     exit;
        // }
    
        // session_start();
        // $_SESSION['accessToken'] = $data['accessToken'];
        // $_SESSION['expiresIn'] = $data['expiresIn'];
        // $_SESSION['role_id'] = $data['role_id'];
        // $_SESSION['user_id'] = $data['user_id'];
    
        // echo json_encode(['success' => true]);
    }
    

    public function logout() {
        // session_start();
        // session_unset();
        // session_destroy();

        // if (ini_get("session.use_cookies")) {
        //     $params = session_get_cookie_params();
        //     setcookie(session_name(), '', time() - 42000,
        //         $params["path"], $params["domain"],
        //         $params["secure"], $params["httponly"]
        //     );
        // }

        // header('Location: /login');
        // exit(); 
    }
    

}