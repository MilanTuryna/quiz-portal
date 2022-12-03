<?php


namespace App\Controllers\Quizzes;

use App\Controllers\BaseController;
use App\Database\Repository;
use App\Database\Repository\TagRepository;
use App\Database\Table;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class FindTagsController
 * @package App\Controllers\Quizzes
 */
class FindTagsController extends BaseController
{
    private Repository $repository;

    /**
     * FindTagsController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param TagRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, TagRepository $repository)
    {
        parent::__construct($formatter, $explorer);

        $this->repository =$repository;
    }

    /**
     * @param int $id
     * @throws AbortException
     */
    public function actionRead(int $id): void {
        $tags = $this->repository->findByQuiz($id);
        $content = $this->formatter->formatContent(Table::fetchAllToArray($tags), 200);
        $response = new JsonResponse($content, 200, true);
        $this->sendResponse($response);
    }
}