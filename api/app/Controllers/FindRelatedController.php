<?php


namespace App\Controllers;

use App\Database\Repository;
use App\Database\Table;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use Nette\Application\BadRequestException;
use Nette\Database\Explorer;

/**
 * Class FindRelatedController
 * @package App\Controllers
 */
class FindRelatedController extends BaseController
{
    /**
     * FindRelatedController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer)
    {
        parent::__construct($formatter, $explorer);
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $related
     * @param int|null $page
     * @throws AbortException
     * @throws BadRequestException
     */
    public function actionRead(string $table, string $id, string $related, ?int $page = null) {
        // Checking if it's possible to create query from client inputs (checking is column exist, relations etc.)
        $table = array_key_exists($table, Table::ROUTER_TO_TABLE) ? Table::ROUTER_TO_TABLE[$table] : null;
        $foreignKey = array_key_exists($table, Table::FOREIGN_KEYS) ? Table::FOREIGN_KEYS[$table] : null;
        $related = array_key_exists($related, Table::ROUTER_TO_TABLE) ? Table::ROUTER_TO_TABLE[$related] : null;
        if(!$table || !$foreignKey || !$related || !in_array($foreignKey, Table::RELATIONS[$related])) $this->error();

        $repository = new Repository($related, $this->explorer);
        $rows = $repository->findAll()->where($foreignKey . " = ?", $id);
        $lastPage = null;
        $content = $this->formatter->formatContent([
            "results" => Table::fetchAllToArray($page ? $rows->page($page, 30, $lastPage)->fetchAll() : $rows->fetchAll()),
            "pagination" => $page ? [
                "page" => $page,
                "lastPage" => $lastPage,
                "pageExist" => !($page > $lastPage)
            ] : null,
        ], 200);
        $response = new JsonResponse($content, 200, true);
        $this->sendResponse($response);
    }
}