<?php

namespace App\Controllers\Quizzes;

use App\Controllers\AllBaseController;
use App\Database\Repository\QuizRepository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Controllers\Quizzes
 */
class AllController extends AllBaseController
{

    /**
     * AllController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param QuizRepository $quizRepository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, QuizRepository $quizRepository)
    {
        parent::__construct($formatter, $explorer, $quizRepository);
    }
}