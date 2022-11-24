<?php

namespace App\ElasticSearch;

use Nette\Database\Explorer;

/**
 * Class AbstractRepository
 * @package App\ElasticSearch
 */
abstract class AbstractRepository
{
    protected string $table;
    protected Explorer $explorer;

    /**
     * AbstractRepository constructor.
     * @param string $table In elastic search type == table of MySQL
     */
    public function __construct(string $table, Explorer $explorer) {
        $this->table = $table;
        $this->explorer = $explorer;
    }
}