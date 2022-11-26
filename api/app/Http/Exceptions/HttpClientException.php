<?php

namespace App\Http\Exceptions;

use Exception;
use Throwable;

/**
 * Class ClientResponseException
 * @package App\Http\Exceptions
 * Class for response exception to client but prevent sharing something like inner credentials
 */
class HttpClientException extends Exception
{
    private Throwable $serverException;

    /**
     * ClientResponseException constructor.
     * @param string $message
     * @param Throwable $exception
     */
    public function __construct(string $message, Throwable $exception)
    {
        $this->serverException = $exception;

        parent::__construct($message, $exception->getCode());
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void {
        $this->message = $message;
    }

    /**
     * @return Throwable
     */
    public function getServerException(): Throwable
    {
        return $this->serverException;
    }
}