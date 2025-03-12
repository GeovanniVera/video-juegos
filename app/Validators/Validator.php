<?php

namespace App\Validators;

class Validator{
    public static function required($value,string $field){
        if(empty(trim($value))){
            return "El campo $field es obligatorio";
        }
        return null;
    }

    public static function isEmailValid($value){
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            return "El Email es invalido";
        }
    }
}