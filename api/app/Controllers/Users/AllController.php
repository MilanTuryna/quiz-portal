<?php


namespace App\Controllers\Users;


use App\Controllers\AllBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class AllController
 * @package App\Controllers\Users
 */
class AllController extends AllBaseController
{
    /**
     * AllController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\UserRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\UserRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}