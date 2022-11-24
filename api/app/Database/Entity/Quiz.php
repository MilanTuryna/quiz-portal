<?php

namespace App\Database\Entity;

/**
 * Class Quiz
 * @package App\Database\Entity
 */
final class Quiz
{
    const name = "name";
    const description = "description";
    const categoryId = "categoryId";
    const difficulty = "difficulty";
    const type = "type";
    const userId = "userId";
    const private = "private";
    const id = "id";

    public string $name;
    public string $description;
    public int $categoryId;
    public int $difficulty; // <1-5>
    public string $type;
    public int $userId;
    public bool $private;
    public int $id;
}