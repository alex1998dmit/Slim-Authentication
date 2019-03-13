<?php

namespace App\Controllers;

use App\Models\User;
use \Slim\Views\Twig as View; 
use \App\Controllers\Controller as Controller;


class HomeController extends Controller
{

   public function index($request, $response)
   {
      return $this->container->view->render($response, 'index.html');
   }

   // for react test 
   public function getUsers($request, $response) {
      $result = [
         'status' => 'ok', 
         'errorCode' => 0
      ];
      $app->response->setStatus(200);
      $app->response['Content-Type'] = 'application/json';
   }

}

?>