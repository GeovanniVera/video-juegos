<?php
namespace App\Core;

class Database {
    private $host = "localhost";
    private $db_name = "sistema_login";
    private $username = "root";
    private $password = "vera230901";
    private $port = "3306";
    
    private \PDO $conn; // Propiedad privada
    private static ?self $instance = null; // PHP 7.4+
    
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};port={$this->port}";
            $this->conn = new \PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (\PDOException $exception) {
            error_log("Error de conexión: " . $exception->getMessage());
            throw new \RuntimeException("Error al conectar con la base de datos"); 
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self(); 
        }
        return self::$instance;
    }

    public function getConnection(): \PDO {
        return $this->conn;
    }

    // Elimina closeConnection() o añade lógica para reiniciar la instancia
}