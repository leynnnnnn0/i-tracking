<?php

namespace App\Exceptions;

use Exception;

class InsufficientQuantityException extends Exception
{
    public function __construct($message = "Insufficient equipment quantity")
    {
        parent::__construct($message);
    }

    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage()
        ], 400);
    }
}
