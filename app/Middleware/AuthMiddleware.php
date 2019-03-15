<?php 

namespace App\Middleware;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;


class AuthMiddleware extends Middleware 
{
    public function __invoke($request, $response, $next) 
    {

        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('error', 'Please sign in doing that'); 
            return $responce->withRedirect($this->container->router->pathFor('auth.signIn'));
        }

        $response = $next($request, $response);
        return $response;
    }
}

