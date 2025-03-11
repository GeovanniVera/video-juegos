<?php

namespace App\Controllers;

class LoginController extends BaseController {
    public function loginForm() {
        $data = [];
        $this->render('auth/login',$data);
    }

    public function loginProcess() {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            var_dump($_POST);
            header("Location:  /login");
        }
    }
}
