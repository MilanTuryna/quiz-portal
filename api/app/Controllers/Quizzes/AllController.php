<?php

namespace App\Controllers\Quizzes;

use App\Controllers\BaseController;
use App\Database\Repository\QuizRepository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Controllers\Quizzes
 */
class AllController extends BaseController
{
    private QuizRepository $quizRepository;

    /**
     * AllController constructor.
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
     * @param int $page
     * @param string|null $order
     * @throws AbortException
     */
    public function actionRead(int $page, ?string $order = null): void {
        $quizzes = $this->quizRepository->findAll($order);

        $lastPage = 0;
        $responseContent = $this->formatter->formatContent([
            "results" => array_values(array_map(fn($activeRow) => $activeRow->toArray(), $quizzes->page($page, 30, $lastPage)->fetchAll())),
            "pagination" => [
                "page" => $page,
                "lastPage" => $lastPage
            ]
        ],200);
        $response = new JsonResponse($responseContent, 200, true);
        $this->sendResponse($response);
    }
}