<?php

namespace App\Database;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

/**
 * Class AbstractRepository
 * @package App\Database
 */
abstract class Repository
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
     * @param int $id
     * @return ActiveRow|null
     */
    public function findById(int $id): ?ActiveRow {
        return $this->explorer->table($this->table)->wherePrimary($id)->fetch();
    }

    /**
     * @param int $id
     * @param iterable $data
     * @return int
     */
    public function updateById(int $id, iterable $data): int
    {
        return $this->explorer->table($this->table)->wherePrimary($id)->update($data);
    }

    /**
     * @param string|null $orderQuery
     * @return Selection
     */
    public function findAll(?string $orderQuery = null): Selection {
        return $orderQuery ? $this->explorer->table($this->table)->order($orderQuery) : $this->explorer->table($this->table);
    }

    /**
     * @param int $id
     * @return int
     */
    public function deleteById(int $id): int {
        return $this->explorer->table($this->table)->wherePrimary($id)->delete();
    }

    /**
     * @return int
     */
    public function getCount(): int {
        return $this->explorer->table($this->table)->count("*");
    }
}