<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;

/**
 * Class TagRepository
 * @package App\Database\Repository
 */
class TagRepository extends Repository
{
    /**
     * TagRepository constructor.
     * @param Explorer $explorer
     */
    public function __construct(Explorer $explorer)
    {
        parent::__construct(Table::TAG, $explorer);
    }

    /**
     * @param int $id
     * @return array
     */
    public function findByQuiz(int $id): array
    {
        return $this->findAll()->select("tag, id")->where(Table::FOREIGN_KEYS[Table::QUIZ] . " = ?", $id)->fetchAll();
    }
}