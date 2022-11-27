<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class PointsRepository
 * @package App\Database\Repository
 */
class PointsRepository extends Repository
{
    /**
     * PointsRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::POINTS, $explorer);
    }
}