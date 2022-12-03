<?php


namespace App\Controllers;

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
    public function __construct(ResponseFormatter $formatter, Explorer $explorer)
    {
        parent::__construct($formatter, $explorer);
    }

    /**
     * @param string $table
     * @param string $id
     * @param string $related
     * @throws AbortException|BadRequestException
     */
    public function actionRead(string $table, string $id, string $related) {
        if(!array_key_exists($table, Table::ROUTER_TO_TABLE) || !array_key_exists($related, Table::ROUTER_TO_TABLE)) $this->error();
        $table = Table::ROUTER_TO_TABLE[$table];
        $related = Table::ROUTER_TO_TABLE[$related];
        $foreignKey = Table::FOREIGN_KEYS[$table];
        $rows = $this->explorer->table($related)->where($foreignKey . " = ?", $id)->fetchAll();
        $content = $this->formatter->formatContent(Table::fetchAllToArray($rows), 200);
        $response = new JsonResponse($content, 200, true);
        $this->sendResponse($response);
    }
}