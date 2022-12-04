<?php

namespace App\Controllers\Questions;

use App\Controllers\FindBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class FindController
 */
class FindController extends FindBaseController
{
    /**
     * FindController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\QuestionRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\QuestionRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}