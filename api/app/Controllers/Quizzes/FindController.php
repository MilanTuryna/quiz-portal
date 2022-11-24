<?php

namespace App\Controllers\Quizzes;

use App\Controllers\BaseController;
use App\Database\Table;
use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;

/**
 * Class FindController
 * @package App\Controllers\Categories
 */
class FindController extends BaseController
{
    /**
     * @throws AbortException
     */
    public function actionRead(int $id): void {
        $row = $this->explorer->table($id)->wherePrimary($id)->fetch();
        $data = $row ? $row->toArray() : [];
        $response = new JsonResponse($data, $row ? 200 : 404);
        $this->sendResponse($response);
    }

    /**
     * @throws AbortException
     */
    public function actionDelete(int $id): void {
        $affectedRows = $this->explorer->table(Table::QUIZZES)->wherePrimary($id)->delete();
        $response = new JsonResponse([
            'affectedRows' => $affectedRows
        ], 200);
        $this->sendResponse($response);
    }

    public function actionUpdate(int $id) {

    }
}