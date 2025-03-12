<?php

namespace App\Services;

use App\Models\User;
use App\Validators\Validator;
use App\Repositories\UserRepository;
use App\Core\Session;

class LoginService {
   
    public function login($data){
      
        $errors = [];

        
        if($error = Validator::required($data['email'],'Email')){
            $errors[]=$error;
        } 
        

        //Encontrar si existe el usuario
        $userRepo = new UserRepository();
        $user = $userRepo->findBy($data['email'],'email');
    
        if(empty($user)){
            $errors[]="Usuario no existe";
        }

        if(!empty($errors)){
            return $errors;
        }


        if($user->getPassword() == $data['password']){
            $errors[]="Contrasenia incorrecta";
        }

        Session::set('usuario',$user);

        
    }
}