<?php

namespace App\Database\Repository;

use App\Database\Repository;
use App\Database\Table;
use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

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

    /**
     * @param string|null $orderQuery
     * @param array|null $select
     * @param bool $includesPrivate
     * @return Selection
     */
    public function findAll(?string $orderQuery = null, ?array $select = null, bool $includesPrivate = false): Selection
    {
        return parent::findAll()->group("tag");
    }
}