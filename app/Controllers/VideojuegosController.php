<?php

namespace App\Controllers;
use App\Repositories\UserRepository;

class VideojuegosController extends BaseController {
    public function index() {
        $data = [];
        $this->render('videojuegos/index',$data);
    }

    
}
