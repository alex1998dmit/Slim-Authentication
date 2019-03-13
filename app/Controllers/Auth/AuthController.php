<?php

namespace App\Controllers\Auth;

// use App\Models\User;
// use \Slim\Views\Twig as View; 
use \App\Controllers\Controller as Controller;


class AuthController extends Controller
{
    public function getSignUp($request, $responce) 
    {
        return $this->view->render($responce, 'auth/signUp.html');
    }

    public function postSignUp($request, $responce) 
    {
        
    }

}

?>