<?php


namespace App\Controllers;

use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class NewBaseController
 * @package App\Controllers
 */
abstract class NewBaseController extends BaseController
{
    protected Repository $repository;
    /**
     * NewBaseController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository $repository)
    {
        parent::__construct($formatter, $explorer);

        $this->repository = $repository;
    }

    public function actionCreate() {

    }
}