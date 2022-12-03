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

    const ROUTER_TO_TABLE = [
        "quizzes" => Table::QUIZ,
        "questions" => Table::QUESTION,
        "categories" => Table::CATEGORY,
        "reviews" => Table::REVIEW,
        "users" => Table::USER,
        "tags" => Table::TAG,
        "points_transactions" => Table::POINTS_TRANSACTION,
        "points" => Table::POINTS
    ];

    const FOREIGN_KEYS = [
        Table::QUIZ => "quizId",
        Table::USER => "userId",
        Table::CATEGORY => "categoryId"
    ];

    const RELATIONS = [
        Table::QUIZ => [Table::FOREIGN_KEYS[Table::CATEGORY], Table::FOREIGN_KEYS[Table::USER]],
        Table::QUESTION => [Table::FOREIGN_KEYS[Table::USER]],
        Table::REVIEW => [Table::FOREIGN_KEYS[Table::USER], Table::FOREIGN_KEYS[Table::QUIZ]],
        Table::TAG => [Table::FOREIGN_KEYS[Table::QUIZ]]
    ];

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

    /**
     * @param $rows
     * @return array
     */
    public static function fetchAllToArray($rows): array {
        return array_values(array_map(function ($activeRow) {
            return $activeRow->getIterator();
        }, $rows));
    }
}