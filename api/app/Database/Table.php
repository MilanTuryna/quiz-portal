<?php

namespace App\Database;

/**
 * Class Table
 * @package App\Database
 */
class Table
{
    const QUIZ = "quiz";
    const CATEGORY = "category";
    const QUESTION = "question";
    const REVIEW = "review";
    const TAG = "tag";
    const USER = "user";
    const POINTS = "points";
    const POINTS_TRANSACTION = "points_transaction";

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