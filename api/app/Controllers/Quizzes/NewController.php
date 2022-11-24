<?php


namespace App\Controllers\Quizzes;


use App\Http\Responses\JsonResponse;
use Nette\Application\AbortException;
use App\Controllers\BaseController;

/**
 * Class NewController
 * @package App\Controllers\Quizzes
 */
class NewController extends BaseController
{
    /**
     * @throws AbortException
     */
    public function actionCreate() {
        $content = $this->formatter->formatContent(["message" => "create"], 201);
        $response = new JsonResponse($content);
        $this->sendResponse($response);
    }
}