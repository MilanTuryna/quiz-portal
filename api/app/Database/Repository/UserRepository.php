<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class UserRepository
 * @package App\Database\Repository
 */
class UserRepository extends Repository
{
    /**
     * UserRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::USER, $explorer);
    }
}