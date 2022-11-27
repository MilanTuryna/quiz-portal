<?php

namespace App\Http\Responses;

use Nette\Application\Response;
use Nette\Http\IRequest;
use Nette\Http\IResponse;
use Nette\SmartObject;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class JsonResponse
 * @package App\Http\Responses
 * Inspired by original Nette JsonResponse
 */
final class JsonResponse implements Response
{
    use SmartObject;

    private int $httpCode;
    private bool $pretty;
    private array $payload;
    private string $contentType;
    private int $flags;


    /**
     * JsonResponse constructor.
     * @param array $payload
     * @param int $httpCode
     * @param bool $pretty
     * @param string|null $contentType
     * @param int $flags
     */
    public function __construct(array $payload, int $httpCode = 200, bool $pretty = false, ?string $contentType = null, int $flags = 0)
    {
        $this->payload = $payload;
        $this->contentType = $contentType ?: 'application/json';
        $this->httpCode = $httpCode;
        $this->pretty = $pretty;
        $this->flags = $flags;
    }


    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }


    /**
     * Returns the MIME content type of a downloaded file.
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }


    /**
     * Sends response to output.
     */
    public function send(IRequest $httpRequest, IResponse $httpResponse): void
    {
        $httpResponse->setContentType($this->contentType, 'utf-8');
        $httpResponse->setCode(array_key_exists('code', $this->payload) ? $this->payload['code'] : $this->httpCode);
        echo $this;
    }

    /**
     * @throws JsonException
     */
    public function __toString(): string
    {
        return Json::encode($this->payload, ($this->pretty ? JSON_PRETTY_PRINT : 0)|$this->flags);
    }
}