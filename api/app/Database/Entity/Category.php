<?php


namespace App\Database\Entity;

/**
 * Class Category
 * @package App\Database\Entity
 */
class Category
{
    const name = "name";
    const url = "url";
    const level = "level";
    const parent_id = "parent_id";
    const id = "id";

    public string $name;
    public string $url;
    public int $level;
    public int $parent_id;
    public int $id;
}