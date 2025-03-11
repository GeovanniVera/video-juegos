<?php

namespace App\Controllers;
use App\Core\Session;

abstract class BaseController{
    public function checkAuth(): void {
        if (!Session::has('usuario')) {
            header('Location: /login');
            exit();
        }
    }

    public function render(String $view, array $data){
        extract($data);
        include __DIR__."/../View/$view".".php";
        exit;
    }
}