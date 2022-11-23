<?php

namespace App\Http;

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
     * @param array $payload
     * @param int $code
     * @return array
     */
    public function formatPayload(array $payload, int $code): array
    {
        return $this->formatContent(["payload" => $payload], $code);
    }

    /**
     * @param Throwable $e
     * @param int|null $code
     * @return array
     */
    public function formatException(Throwable $e, int $code = null): array
    {
        return $this->formatContent(["error" => $e->getMessage()], $code ?: $e->getCode(), self::STATUS_ERROR);
    }
}