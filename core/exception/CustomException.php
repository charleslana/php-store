<?php

namespace core\exception;

use Exception;

class CustomException extends Exception
{

    public function errorMessage(): string
    {
        return 'Erro na linha ' . $this->getLine() . ' em ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b>';
    }
}