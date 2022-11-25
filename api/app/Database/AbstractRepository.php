<?php

namespace App\ElasticSearch;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

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

    /**
     * @return string
     */
    public function getTable(): string {
        return $this->table;
    }

    /**
     * @param string|null $orderQuery
     * @return Selection
     */
    public function findAll(?string $orderQuery = null): Selection {
        return $orderQuery ? $this->explorer->table($this->table)->order($orderQuery) : $this->explorer->table($this->table);
    }

    /**
     * @return int
     */
    public function getCount(): int {
        return $this->explorer->table($this->table)->count("*");
    }
}