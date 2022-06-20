<?php

namespace Exceptions;

class InputException extends \Exception
{
    private $data;

    public function __construct($data, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}