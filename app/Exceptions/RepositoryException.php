<?php

namespace App\Exceptions;

use PDOException;

class RepositoryException extends PDOException
{
    public function __construct(string $message = "", int $code = 0, PDOException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
