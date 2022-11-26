<?php

namespace App\Http;

use App\Http\Exceptions\HttpClientException;
use App\Http\Exceptions\Messages;
use Nette\Database\DriverException;
use Throwable;

/**
 * Class ResponseFormatter
 * @package App\Http
 */
final class ResponseFormatter
{
    const STATUS_OK = "ok";
    const STATUS_ERROR = "error";

    /**
     * @param array $content
     * @param int $code
     * @param string $status
     * @return array
     */
    public function formatContent(array $content, int $code, string $status = self::STATUS_OK): array
    {
        return [
            'status' => self::STATUS_OK,
            'code' => $code,
            'content' => $content
        ];
    }

    /**
     * @param Throwable $exception
     * @param int|null $code
     * @return array
     */
    public function formatException(Throwable $exception, int $code = null): array
    {
        if($exception instanceof DriverException) {
            if(!$code) $code = 400;
            $message = Messages::SQL_EXCEPTION;
        } else {
            $message = get_class($exception);
            if(!$code) $code = 500;
        }
        $clientException = new HttpClientException($message, $exception);
        return $this->formatContent(["error" => ["message" => $message, "code" => $clientException->getCode(), "exception" => get_class($exception)]], $code ?: $clientException->getCode(), self::STATUS_ERROR);
    }
}