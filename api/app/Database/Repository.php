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
    private function getAllowedValues(): string {
        return array_key_exists($this->table, Table::ALLOWED_VALUES) ? implode(",",Table::ALLOWED_VALUES[$this->table]) : '*';
    }

    /**
     * @return bool
     */
    private function hasPrivateColumns(): bool {
        return property_exists(Table::ENTITIES[$this->table], "private");
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
     * @param bool $includesPrivate
     * @return ActiveRow|null
     */
    public function findById(int $id, ?array $select = null, bool $includesPrivate = false): ?ActiveRow {
        if(!$select) $select = $this->getAllowedValues();
        $table = $this->explorer->table($this->table)->wherePrimary($id);
        if(!$includesPrivate && $this->hasPrivateColumns()) $table->where("private = ?", 0);
        return $select ? $table->select($select)->fetch() : $table->fetch();
    }

    /**
     * @param string $column
     * @param string $value
     * @param array|null $select
     * @param bool $includesPrivate
     * @return ActiveRow|null
     */
    public function findByColumn(string $column, string $value, ?array $select = null, bool $includesPrivate = false): ?ActiveRow {
        if(!$select) $select = $this->getAllowedValues();
        $table = $this->explorer->table($this->table);
        if(!$includesPrivate && $this->hasPrivateColumns()) $table->where("private = ?", 0);
        return $table->select($select)->where($column . " = ?", $value)->fetch();
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
     * @param bool $includesPrivate
     * @return Selection
     */
    public function findAll(?string $orderQuery = null, ?array $select = null, bool $includesPrivate = false): Selection {
        if(!$select) $select = $this->getAllowedValues();
        $table = $this->explorer->table($this->table);
        if(!$includesPrivate && $this->hasPrivateColumns()) $table->where("private = ?", 0);
        $orderBuild = $orderQuery ? $table->order($orderQuery) : $table;
        return $orderBuild->select($select);
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