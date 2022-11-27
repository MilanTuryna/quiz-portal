<?php

namespace App\Controllers;

use Nette\Application\AbortException;
use Nette\Application\Responses\TextResponse;
use App\Controllers\BaseController;

/**
 * Class HomeController
 * @package App\Controllers
 */
abstract class HomeController extends BaseController
{
    /**
     * @throws AbortException
     */
    public function actionDefault() {
        $text = new TextResponse("Welcome to API. Check <a href='https://github.com/milanturyna/quiz-portal'>https://github.com/milanturyna/quiz-portal</a> for more :)");
        $this->sendResponse($text);
    }
}