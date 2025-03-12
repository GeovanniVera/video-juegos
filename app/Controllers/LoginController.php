<?php

namespace App\Controllers;

use App\Core\Session;
use App\Services\LoginService;

class LoginController extends BaseController {
    public function loginForm() {
        
        if(Session::has('errores')){
            $errores = Session::get('errores');
        }
        $data = [
            'errores' => $errores
        ];
        $this->render('auth/login',$data);
    }

    public function loginProcess() {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $service = new LoginService();
            $response = $service->login($_POST);

            var_dump($response);
            var_dump($_SESSION);
            
        }
    }
}
