<?php

namespace App\Extensions\Elastica;

use App\Extensions\DisabledExtension;
use Elastica\Request;
use Elastica\Response;
use Nette\SmartObject;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Class Client
 * @package App\Extensions\Elastica
 */
class Client extends \Elastica\Client
{
    use SmartObject;

    /**
     * If $enabled is false, then it's throws DisabledExtension exception every time it's called
     * @var bool $enabled
     */
    private bool $enabled;

    /** @var callable[] */
    public array $onSuccess = [];

    /** @var callable[] */
    public array $onFailure = [];

    /**
     * @throws DisabledExtension
     */
    public function __call($name, $args)
    {
        if(!$this->enabled && $name !== "isEnabled")
            throw new DisabledExtension("Extension Elastica is disabled now. It is possible to be enabled in future, but edit your code and handle this problem/situation.");
    }

    /**
     * Client constructor.
     * @param array $config
     * @param bool $enabled
     * @param callable|null $callback
     * @param LoggerInterface|null $logger
     */
    public function __construct($config = [], $enabled = true, ?callable $callback = null, ?LoggerInterface $logger = null)
    {
        $this->enabled = $enabled;

        if($this->enabled) parent::__construct($config, $callback, $logger);
    }

    public function isEnabled(): bool {
        return $this->enabled;
    }

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