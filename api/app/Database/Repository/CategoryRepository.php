<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class CategoryRepository
 * @package App\Database\Repository
 */
class CategoryRepository extends Repository
{
    /**
     * CategoryRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::CATEGORY, $explorer);
    }
}