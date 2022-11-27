<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class PointsTransactionRepository
 * @package App\Database\Repository
 */
class PointsTransactionRepository extends Repository
{
    /**
     * PointsTransactionRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::POINTS_TRANSACTION, $explorer);
    }
}