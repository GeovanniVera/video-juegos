<?php

namespace App\Repositories;

use App\Core\Database;
use App\Core\ErrorLogger;
use App\Exceptions\RepositoryException;
use PDO;
use PDOException;

define("LOG_FILE_PATH", realpath(__DIR__ . '/../../storage/logs/mi_aplicacion.log'));


abstract class BaseRepository
{
    protected $conn;
    protected string $table;
    protected $log;
    public function __construct(string $table)
    {

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \InvalidArgumentException("El nombre de la tabla no es válido");
        }
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
        $this->table = $table;
    }

    abstract public function getModelClass(): string;

    public function all(): ?array
    {
        try {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($results)) {
                return null;
            }
            $models = [];
            foreach ($results as $row) {
                $models[] = $this->arrayToModel($row);
            }
            return $models;
        } catch (PDOException $e) {
            $error = new ErrorLogger(LOG_FILE_PATH);
            $repositoryException = new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
            $error->logRepositoryException($repositoryException); // Cambiado a $repositoryException
            throw $repositoryException; // Lanzar la RepositoryException
        }
    }

    public static function find($id) : ?object{
        $query = "SELECT * FROM ". self::$table." WHERE id = :id";
        try {
            $query = "SELECT * FROM " . self::$table;
            $stmt = self::$conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($result)){
                return null;
            }
            return self::arrayToModel($result);
            
        } catch (PDOException $e) {
            $error = new ErrorLogger(LOG_FILE_PATH);
            $repositoryException = new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
            $error->logRepositoryException($repositoryException); // Cambiado a $repositoryException
            throw $repositoryException;
        }
    }

    public function findBy($value,$field) : ?object{
        try {
            $query = "SELECT * FROM ". $this->table." WHERE $field = :$field";
            $stmt = $this->conn->prepare($query);
            $stmt ->bindValue(":$field",$value,PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($result)){
                return null;
            }
            return self::arrayToModel($result);
            
        } catch (PDOException $e) {
            $error = new ErrorLogger(LOG_FILE_PATH);
            $repositoryException = new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
            $error->logRepositoryException($repositoryException); // Cambiado a $repositoryException
            throw $repositoryException;
        }
    }

    public function save(object $model): bool
    {
        if ($model->id === null) {
            return $this->create($model);
        } else {
            return $this->update($model);
        }
    }

    public function create(object $model): bool
    {
        try {
            $data = $this->getModelData($model); // Obtener los datos del modelo como un array asociativo
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));

            $query = "INSERT INTO " . $this->table . " ({$columns}) VALUES ({$placeholders})";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($data);

            // Actualizar el ID del modelo con el ID generado automáticamente
            $model->id = $this->conn->lastInsertId();

            return true;
        } catch (PDOException $e) {
            $error = new ErrorLogger(LOG_FILE_PATH);
            $repositoryException = new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
            $error->logRepositoryException($repositoryException); // Cambiado a $repositoryException
            throw $repositoryException;
        }
    }

    public function update(object $model): bool
{
    try {
        $data = $this->getModelData($model); // Obtener los datos del modelo como un array asociativo
        $setClauses = '';
        foreach (array_keys($data) as $column) {
            $setClauses .= "{$column} = :{$column}, ";
        }
        $setClauses = rtrim($setClauses, ', '); // Eliminar la coma extra al final

        $query = "UPDATE " . $this->table . " SET {$setClauses} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);

        return true;
    } catch (PDOException $e) {
        $error = new ErrorLogger(LOG_FILE_PATH);
        $repositoryException = new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
        $error->logRepositoryException($repositoryException); // Cambiado a $repositoryException
        throw $repositoryException;
    }
}

    protected function getModelData(object $model): array
    {
        $data = [];
        foreach (get_object_vars($model) as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }
    abstract protected function arrayToModel(array $data);
}
