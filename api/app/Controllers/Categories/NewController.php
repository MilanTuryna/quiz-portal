<?php


namespace App\Controllers\Categories;

use App\Controllers\NewBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class NewController
 * @package App\Controllers\Categories
 */
class NewController extends NewBaseController
{
    /**
     * NewController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\CategoryRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\CategoryRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}