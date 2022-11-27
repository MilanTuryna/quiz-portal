<?php


namespace App\Controllers;


use App\Database\Repository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;
use Nette\Utils\JsonException;

/**
 * Class FindBaseController
 * @package App\Controllers
 */
class FindBaseController extends BaseController
{
    protected Repository $repository;

    /**
     * FindBaseController constructor.
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
     * @throws AbortException
     */
    public function actionRead(int $id): void {
        $row = $this->repository->findById($id);
        $data = $row ? $row->toArray() : [];
        $code = $row ? 200 : 404;
        $content = $this->formatter->formatContent($data, $code);
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }

    /**
     * @throws AbortException
     */
    public function actionDelete(int $id): void {
        $affectedRows = $this->repository->deleteById($id);
        $response = new JsonResponse([
            'deleted' => (bool)$affectedRows
        ], 200);
        $this->sendResponse($response);
    }

    /**
     * @throws JsonException|AbortException
     */
    public function actionUpdate(int $id) {
        $updatedRow = $this->repository->updateById($id, $this->getBody());
        $response = new JsonResponse([
            'updated' => (bool)$updatedRow
        ], 200);
        $this->sendResponse($response);
    }
}