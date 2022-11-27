<?php


namespace App\Controllers\Users;

use App\Controllers\NewBaseController;
use App\Database\Repository;
use App\Http\ResponseFormatter;
use Nette\Database\Explorer;

/**
 * Class NewController
 * @package App\Controllers\Users
 */
class NewController extends NewBaseController
{
    /**
     * NewController constructor.
     * @param ResponseFormatter $formatter
     * @param Explorer $explorer
     * @param Repository\UserRepository $repository
     */
    public function __construct(ResponseFormatter $formatter, Explorer $explorer, Repository\UserRepository $repository)
    {
        parent::__construct($formatter, $explorer, $repository);
    }
}