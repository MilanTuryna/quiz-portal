<?php

namespace App\Controllers\Quizzes;

use App\Controllers\FindBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class FindController
 * @package App\Controllers\Categories
 */
class FindController extends FindBaseController
{
    /**
     * FindController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\QuizRepository $quizRepository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\QuizRepository $quizRepository)
    {
        parent::__construct($formatter, $explorer, $quizRepository);
    }
}