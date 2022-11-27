<?php


namespace App\Controllers\Quizzes;


use App\Controllers\NewBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class NewController
 * @package App\Controllers\Quizzes
 */
class NewController extends NewBaseController
{
    /**
     * NewController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\QuizRepository $quizRepository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\QuizRepository $quizRepository)
    {
        parent::__construct($formatter, $explorer, $quizRepository);
    }
}