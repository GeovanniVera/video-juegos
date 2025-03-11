<?php

namespace App\Repositories;

use App\Core\Database;
use App\Exceptions\RepositoryException;
use PDO;
use PDOException;

define("LOG_FILE_PATH", realpath(__DIR__ . '/../../storage/logs/mi_aplicacion.log'));


abstract class BaseRepository
{
    protected static $conn;
    protected static string $table;

    public function __construct(string $table)
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new \InvalidArgumentException("El nombre de la tabla no es válido");
        }

        $database = Database::getInstance();
        self::$conn = $database->getConnection();
        self::$table = $table;
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
            $modelClass = $this->getModelClass();
            $models = [];
            foreach ($results as $row) {
                $models[] = new $modelClass($row); // Asumiendo que el modelo tiene un constructor que recibe un array asociativo
            }
            return $models;
        } catch (PDOException $e) {
            error_log(date("Y-m-d H:i:s") . " - Error en BaseRepository::all(): " . $e->getMessage() . "\n", 3, LOG_FILE_PATH); // El '3' indica que se registra en un archivo
            throw new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
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
            error_log(date("Y-m-d H:i:s") . " - Error en BaseRepository::all(): " . $e->getMessage() . "\n", 3, LOG_FILE_PATH); // El '3' indica que se registra en un archivo
            throw new RepositoryException("Error al recuperar datos: " . $e->getMessage(), 0, $e);
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
            error_log(date("Y-m-d H:i:s") . " - Error en BaseRepository::create(): " . $e->getMessage() . "\n", 3, LOG_FILE_PATH);
            throw new RepositoryException("Error al crear registro: " . $e->getMessage(), 0, $e);
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
        error_log(date("Y-m-d H:i:s") . " - Error en BaseRepository::update(): " . $e->getMessage() . "\n", 3, LOG_FILE_PATH);
        throw new RepositoryException("Error al actualizar registro: " . $e->getMessage(), 0, $e);
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
