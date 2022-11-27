<?php


namespace App\Controllers;


use App\Http\ResponseFormatter;
use Nette\Application\UI\Presenter;
use Nette\Database\Explorer;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController extends Presenter
{
    protected ResponseFormatter $formatter;
    protected Explorer $explorer;

    /**
     * BaseController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer)
    {
        $this->formatter = $formatter;
        $this->explorer = $explorer;

        parent::__construct();
    }

    /**
     * @return array
     * @throws JsonException
     */
    public function getBody(): array {
        return Json::decode($this->getHttpRequest()->getRawBody());
    }
}