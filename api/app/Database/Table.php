<?php

namespace App\Database;

use Nette\Database\Table\ActiveRow;

/**
 * Class Table
 * @package App\Database
 */
class Table
{
    const QUIZ = "quiz";

    /**
     * @param string $table
     * @param ActiveRow[] $rows
     * @return array
     */
    public static function toJSON(string $table, array $rows): array {
        return [
            $table => $rows
        ];
    }
}