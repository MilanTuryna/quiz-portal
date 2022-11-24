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

    /**
     * @var int
     */
    private int $httpCode;

    /**
     * @var bool
     */
    private bool $pretty;

    /**
     * @var array
     */
    private array $payload;

    /** @var string */
    private string $contentType;


    /**
     * JsonResponse constructor.
     * @param array $payload
     * @param int $httpCode
     * @param bool $pretty
     * @param string|null $contentType
     */
    public function __construct(array $payload, int $httpCode = 200, bool $pretty = false, ?string $contentType = null)
    {
        $this->payload = $payload;
        $this->contentType = $contentType ?: 'application/json';
        $this->httpCode = $httpCode;
        $this->pretty = $pretty;
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
     * @throws JsonException
     */
    public function send(IRequest $httpRequest, IResponse $httpResponse): void
    {
        $httpResponse->setContentType($this->contentType, 'utf-8');
        $httpResponse->setCode(array_key_exists('code', $this->payload) ? $this->payload['code'] : $this->httpCode);
        echo Json::encode($this->payload, $this->pretty ? JSON_PRETTY_PRINT : 0);
    }
}