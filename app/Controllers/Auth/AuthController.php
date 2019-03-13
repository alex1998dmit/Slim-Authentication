<?php

namespace App\Controllers\Auth;

use App\Models\User;
// use \Slim\Views\Twig as View; 
use App\Controllers\Controller as Controller;
use Respect\Validation\Validator as v;


class AuthController extends Controller
{
    public function getSignUp($request, $responce) 
    {
        return $this->view->render($responce, 'auth/signUp.html');
    }

    public function postSignUp($request, $responce) 
    {

        $validation = $this->container->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty(),
            'name' => v::noWhitespace()->notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        
        return $responce->withRedirect($this->router->pathFor('auth.signUp'));
    }

}

?>