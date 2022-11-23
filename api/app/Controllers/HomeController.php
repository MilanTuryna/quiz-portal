<?php

namespace App\Controllers;

use Nette\Application\AbortException;
use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Presenter;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Presenter
{
    /**
     * @throws AbortException
     */
    public function actionDefault() {
        $text = new TextResponse("Welcome to API. Check <a href='https://github.com/milanturyna/quiz-portal'>https://github.com/milanturyna/quiz-portal</a> for more :)");
        $this->sendResponse($text);
    }
}