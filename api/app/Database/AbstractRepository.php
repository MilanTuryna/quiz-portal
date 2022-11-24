<?php

namespace App\ElasticSearch;

use Contributte\Elastica\Client;

/**
 * Class AbstractRepository
 * @package App\ElasticSearch
 */
abstract class AbstractRepository
{
    protected string $table;
    protected Client $es;

    /**
     * AbstractRepository constructor.
     * @param string $table In elastic search type == table of MySQL
     */
    public function __construct(string $table, Client $es) {
        $this->table = $table;
        $this->es = $es;
    }
}