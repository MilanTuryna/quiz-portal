<?php


namespace App\Controllers;


use App\Database\Repository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class AllBaseController
 * @package App\Controllers
 */
abstract class AllBaseController extends BaseController
{
    protected Repository $repository;

    /**
     * AllBaseController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository $repository)
    {
        parent::__construct($formatter, $explorer);

        $this->repository = $repository;
    }

    /**
     * @param int|null $page
     * @param string|null $order
     * @throws AbortException
     */
    public function actionRead(?int $page = null, ?string $order = null): void {
        $quizzes = $this->repository->findAll($order);
        $lastPage = null;
        $responseContent = $this->formatter->formatContent([
            "results" => array_values(array_map(fn($activeRow) => $activeRow->toArray(), $page ? $quizzes->page($page, 30, $lastPage)->fetchAll() : $quizzes->fetchAll())),
            "pagination" => [
                "page" => $page,
                "lastPage" => $lastPage,
                "pageExist" => !($page > $lastPage),
            ]
        ],200);
        $response = new JsonResponse($responseContent, 200, true);
        $this->sendResponse($response);
    }
}