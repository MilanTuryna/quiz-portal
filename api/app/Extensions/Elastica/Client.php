<?php

namespace App\Extensions\Elastica;

use Elastica\Request;
use Elastica\Response;
use Nette\SmartObject;
use Throwable;

/**
 * Class Client
 * @package App\Extensions\Elastica
 */
class Client extends \Elastica\Client
{
    use SmartObject;

    /** @var callable[] */
    public array $onSuccess = [];

    /** @var callable[] */
    public array $onFailure = [];

    /**
     * @param string $path
     * @param string $method
     * @param array|mixed $data
     * @param array $query
     * @param string $contentType
     * @return Response
     */
    public function request(string $path, string $method = Request::GET, $data = [], array $query = [], string $contentType = Request::DEFAULT_CONTENT_TYPE): Response
    {
        $start = microtime(true);
        try {
            return parent::request($path, $method, $data, $query, $contentType);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}