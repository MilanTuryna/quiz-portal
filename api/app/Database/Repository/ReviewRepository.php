<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class ReviewRepository
 * @package App\Database\Repository
 */
class ReviewRepository extends Repository
{
    /**
     * ReviewRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::REVIEW, $explorer);
    }
}