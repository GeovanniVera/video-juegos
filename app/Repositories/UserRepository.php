<?php
namespace App\Repositories;

use App\Models\User; // Asegúrate de que esta ruta sea correcta

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('user'); // Nombre de la tabla
    }

    public function getModelClass(): string
    {
        return User::class;
    }

    // Métodos específicos para usuarios (si los hay)
    //mapear un arreglo a objeto del modelo usuario
    public function arrayToModel(array $data):object{
        return new User(
            $data
        );
    }
}