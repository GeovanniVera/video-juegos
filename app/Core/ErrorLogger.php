<?php

namespace App\Core;
use App\Exceptions\RepositoryException;
use Exception;

class ErrorLogger{
    private $logFile;

    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
        if(!file_exists(dirname($this->logFile))){
            mkdir(dirname($this->logFile),0755,true);
        }
        error_reporting(E_ALL);
        ini_set('display_errors',0);
        ini_set('log_errors',1);
        ini_set('error_log',$this->logFile);
    }

    public function log($message){
        error_log($message);
    }
    
    public  function logException(Exception $e){
        $errorMesage = "Exception: ".$e->getMessage()." en " . $e->getFile() . " linea ".$e->getLine();
        $this->log($errorMesage);
    }

    public function logRepositoryException(RepositoryException $e){
        $errorMesage = "RepositoryException: ".$e->getMessage()." en " . $e->getFile() . " linea ".$e->getLine();
        $this->log($errorMesage);
    }
}