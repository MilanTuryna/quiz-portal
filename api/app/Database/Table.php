<?php

namespace App\Database;

/**
 * Class Table
 * @package App\Database
 */
class Table
{
    const QUIZ = "quiz";

    /**
     * @param string $table
     * @param array $rows
     * @return array
     */
    public static function toJSON(string $table, array $rows): array {
        return [
            $table => $rows
        ];
    }
}