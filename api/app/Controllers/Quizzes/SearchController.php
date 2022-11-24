<?php


namespace App\Controllers\Quizzes;


use App\Controllers\BaseController;
use App\Database\Table;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Contributte\Elastica;
use Nette\Application\AbortException;
use Nette\Database\Explorer;

/**
 * Class SearchController
 * @package App\Controllers\Quizzes
 */
class SearchController extends BaseController
{
    private Elastica\Client $es;

    /**
     * SearchController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Elastica\Client $es
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Elastica\Client $es)
    {
        parent::__construct($formatter, $explorer);

        $this->es->
        $this->es = $es;
    }

    /**
     * @param string $name
     * @throws AbortException
     */
    public function actionRead(string $name): void {
        $tableName = Table::QUIZZES;
        $row = $this->explorer->query('SELECT * FROM ' . $tableName . ' WHERE MATCH(name) AGAINST(?)', [$name])->fetchAll();
        $code = $row ? 200 : 404;
        $content = $this->formatter->formatContent(['quizzes' => $row], $code);
        $response = new JsonResponse($content, $code, true);
        $this->sendResponse($response);
    }
}