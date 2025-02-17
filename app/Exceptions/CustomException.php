<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct($message = "Something went wrong", $code = 425)
    {
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        return response()->json([
            'error' => true,
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
