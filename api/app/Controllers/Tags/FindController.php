<?php


namespace App\Controllers\Tags;

use App\Controllers\FindBaseController;
use App\Database\Entity\Tag;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Database\Explorer;

/**
 * Class FindController
 * @package App\Categories\AllController
 */
class FindController extends FindBaseController
{
    /**
     * FindController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\TagRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\TagRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }

    public function actionRead($id): void
    {
        $row = is_numeric($id) ? $this->repository->findById($id) : $this->repository->findByColumn(Tag::tag, $id);
        $data = $row ? $row->toArray() : new \stdClass();
        $code = $row ? 200 : 404;
        $content = $this->formatter->formatContent($data, $code);
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }
}