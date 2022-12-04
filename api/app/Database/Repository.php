<?php

namespace App\Database;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

/**
 * Class AbstractRepository
 * @package App\Database
 */
class Repository
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
     * @param array|null $select
     * @return ActiveRow|null
     */
    public function findById(int $id, ?array $select = null): ?ActiveRow {
        if(!$select) $select = array_key_exists($this->table, Table::ALLOWED_VALUES) ? Table::ALLOWED_VALUES[$this->table] : ["*"];
        $table = $this->explorer->table($this->table)->wherePrimary($id);
        return $select ? $table->select(implode(",",$select))->fetch() : $table->fetch();
    }

    /**
     * @param string $column
     * @param string $value
     * @param array|null $select
     * @return ActiveRow|null
     */
    public function findByColumn(string $column, string $value, ?array $select = null): ?ActiveRow {
        if(!$select) $select = array_key_exists($this->table, Table::ALLOWED_VALUES) ? Table::ALLOWED_VALUES[$this->table] : ['*'];
        return $this->explorer->table($this->table)->select(implode(",",$select))->where($column . " = ?", $value)->fetch();
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
     * @param array|null $select
     * @return Selection
     */
    public function findAll(?string $orderQuery = null, ?array $select = null): Selection {
        if(!$select) $select = array_key_exists($this->table, Table::ALLOWED_VALUES) ? Table::ALLOWED_VALUES[$this->table] : ['*']; // * must be in array because implode
        $orderBuild = $orderQuery ? $this->explorer->table($this->table)->order($orderQuery) : $this->explorer->table($this->table);
        return $orderBuild->select(implode(",", $select));
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