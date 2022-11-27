<?php

namespace App\Categories\AllController;

use App\Controllers\AllBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Categories\AllController
 */
class AllController extends AllBaseController
{
    /**
     * AllController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\TagRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\TagRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}