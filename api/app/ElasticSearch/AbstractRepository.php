<?php

namespace App\ElasticSearch;

use Contributte\Elastica\Client;

/**
 * Class AbstractRepository
 */
class AbstractRepository
{
    protected string $type;
    protected Client $es;

    /**
     * AbstractRepository constructor.
     * @param string $type
     * @param Client $es
     */
    public function __construct(string $type, Client $es)
    {
        $this->type = $type;
        $this->es = $es;
    }
}