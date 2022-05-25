<?php

namespace core\exception;

use Exception;

class CustomException extends Exception
{

    public function errorMessage(): string
    {
        return 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b>';
    }
}