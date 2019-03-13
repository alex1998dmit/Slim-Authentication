<?php

namespace App\Controllers;

use \Slim\Views\Twig as View; 
use \App\Controllers\Controller as Controller;


class HomeController extends Controller
{

   public function index($request, $response)
   {
        return $this->container->view->render($response, 'index.html');
   }

}

?>