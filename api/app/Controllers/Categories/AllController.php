<?php

namespace App\Controllers\Categories;

use App\Controllers\AllBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Controllers\Categories
 */
class AllController extends AllBaseController
{
    /**
     * AllController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\CategoryRepository $categoryRepository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\CategoryRepository $categoryRepository)
    {
        parent::__construct($formatter, $explorer, $categoryRepository);
    }
}