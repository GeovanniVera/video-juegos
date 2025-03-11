<?php
namespace App\Models;
use InvalidArgumentException;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['nombre'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
    }

    // Métodos específicos del modelo (si los hay)

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getName():String{
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function setEmail(string $email){
        if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El email no es válido");
        }
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPassword($password){
        if(empty($password)){
            throw new InvalidArgumentException("La contraseña no puede ser nula");
        }
        $this->password;
    }

    public function getPassword(){

    }
}