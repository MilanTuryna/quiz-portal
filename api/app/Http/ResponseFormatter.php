<?php

namespace App\Http;

use App\Http\Exceptions\HttpClientException;
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
            'status' => $status,
            'code' => $code,
            'content' => $content
        ];
    }

    /**
     * @param HttpClientException $clientException
     * @param int|null $code
     * @return array
     */
    public function formatException(HttpClientException $clientException, int $code): array
    {
        $splitClassName = explode("\\", get_class($clientException->getServerException()));
        $exceptionName = end($splitClassName);
        $message = $clientException->getMessage() === "" ? $exceptionName : $clientException->getMessage();
        return $this->formatContent(["error" => ["message" => $message, "code" => $clientException->getCode(), "exception" => $exceptionName]], $code, self::STATUS_ERROR);
    }
}