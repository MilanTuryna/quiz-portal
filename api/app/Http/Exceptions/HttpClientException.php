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
    private Exception $serverException;

    /**
     * ClientResponseException constructor.
     * @param string $message
     * @param Exception $exception
     * @param int|null $code
     */
    public function __construct(string $message, Exception $exception, ?int $code = null)
    {
        $this->serverException = $exception;

        parent::__construct($message, $code ?: $exception->getCode());
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