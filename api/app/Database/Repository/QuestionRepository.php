<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class QuestionRepository
 * @package App\Database\Repository
 */
class QuestionRepository extends Repository
{
    /**
     * QuestionRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::QUESTION, $explorer);
    }
}