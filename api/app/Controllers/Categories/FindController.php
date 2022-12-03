<?php

namespace App\Controllers\Categories;

use App\Controllers\FindBaseController;
use App\Database\Entity\Category;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
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
     * @param Repository\CategoryRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\CategoryRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }

    /**
     * @param $id
     * @throws AbortException
     */
    public function actionRead($id): void {
        $row = is_numeric($id) ? $this->repository->findById($id) : $this->repository->findByColumn(Category::name, $id);
        $data = $row ? $row->toArray() : new \stdClass();
        $code = $row ? 200 : 404;
        $content = $this->formatter->formatContent($data, $code);
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }
}