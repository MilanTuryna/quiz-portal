<?php


namespace App\Controllers\Quizzes;


use App\Controllers\BaseController;
use App\Database\Repository\QuizRepository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class SearchController
 * @package App\Controllers\Quizzes
 */
class SearchController extends BaseController
{
    private QuizRepository $quizRepository;

    /**
     * SearchController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param QuizRepository $quizRepository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, QuizRepository $quizRepository)
    {
        parent::__construct($formatter, $explorer);

        $this->quizRepository = $quizRepository;
    }

    /**
     * @param string $name
     * @throws AbortException
     */
    public function actionRead(string $name): void {
        $code = 200;
        try {
            $search = $this->quizRepository->search($name);
            $content = $this->formatter->formatContent($search, $code);
        } catch (\Exception $exception) {
            $content = $this->formatter->formatException($exception);
        }
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }
}