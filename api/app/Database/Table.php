<?php

namespace App\Database;

use App\Database\Entity\Category;
use App\Database\Entity\Points;
use App\Database\Entity\Points_Transaction;
use App\Database\Entity\Question;
use App\Database\Entity\Quiz;
use App\Database\Entity\Review;
use App\Database\Entity\Tag;
use App\Database\Entity\User;

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
        Table::QUESTION => [Table::FOREIGN_KEYS[Table::QUIZ]],
        Table::REVIEW => [Table::FOREIGN_KEYS[Table::USER], Table::FOREIGN_KEYS[Table::QUIZ]],
        Table::TAG => [Table::FOREIGN_KEYS[Table::QUIZ]],
    ];

    const ENTITIES = [
        Table::CATEGORY => Category::class,
        Table::POINTS => Points::class,
        Table::POINTS_TRANSACTION => Points_Transaction::class,
        Table::QUESTION => Question::class,
        Table::QUIZ => Quiz::class,
        Table::REVIEW => Review::class,
        Table::TAG => Tag::class,
        Table::USER => User::class
    ];

    // Values we can see show using public API
    const ALLOWED_VALUES = [
        Table::USER => [ // for example we can return all users, but without password and email
            User::nickname,
            User::id,
            User::date_created,
            User::hideFinishedQuizzes,
            User::points,
        ],
        Table::TAG => [
            Tag::tag,
        ]
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