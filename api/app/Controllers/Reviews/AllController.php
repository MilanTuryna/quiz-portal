<?php

namespace App\Controllers\Reviews;

use App\Controllers\AllBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Controllers\Reviews
 */
class AllController extends AllBaseController
{
    /**
     * AllController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\ReviewRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\ReviewRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}