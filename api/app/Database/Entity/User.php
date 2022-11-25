<?php


namespace App\Database\Entity;

/**
 * Class User
 * @package App\Database\Entity
 */
final class User
{
    const email = "email";
    const nickname = "nickname";
    const passwords = "passwords";
    const datetime = "datetime";
    const hideFinishedQuizzes = "hideFinishedQuizzes";
    const points = "points";
    const id = "id";

    public string $email;
    public string $nickname;
    public string $passwords;
    public string $datetime;
    public bool $hideFinishedQuizzes;
    public int $points;
    public int $id;
}