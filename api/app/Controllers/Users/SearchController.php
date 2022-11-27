<?php


namespace App\Controllers\Users;


use App\Controllers\BaseController;
use App\Database\Repository\UserRepository;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class SearchController
 * @package App\Controllers\Users
 */
class SearchController extends BaseController
{
    public UserRepository $repository;

    /**
     * SearchController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param UserRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, UserRepository $repository)
    {
        parent::__construct($formatter, $explorer);

        $this->repository = $repository;
    }

    /**
     * @param string $username
     * @throws AbortException
     */
    public function actionRead(string $username) { // možnost více výsledků
        $code = 200;
        $search = $this->repository->search($username);
        $content = $this->formatter->formatContent($search, $code);
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }
}