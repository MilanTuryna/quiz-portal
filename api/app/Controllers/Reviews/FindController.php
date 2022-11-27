<?php


namespace App\Controllers\Reviews;


use App\Controllers\AllBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class FindController
 * @package App\Controllers\Reviews0
 */
class FindController extends AllBaseController
{
    /**
     * FindController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\ReviewRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\ReviewRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}