<?php

declare(strict_types=1);

namespace App\Router;

use Contributte\ApiRouter\ApiRoute;
use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

    /**
     * @ApiRoute()
     * Simple route with matching (only if methods below exist):
     * 	GET     => UsersPresenter::actionRead()
     * 	POST    => UsersPresenter::actionCreate()
     * 	PUT     => UsersPresenter::actionUpdate()
     * 	DELETE  => UsersPresenter::actionDelete()
     */

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router[] = new ApiRoute("/users/find/<id>", "Users:find");
        $router[] = new ApiRoute("/users/find/<id>/reviews", "Users:findCategories");
        $router[] = new ApiRoute("/users/find/<id>/quizzes", "Users:findQuizzes");
        $router[] = new ApiRoute("/users/all/<pagination>", "Users:all");
        $router[] = new ApiRoute("/users/new", "Users:new");
		return $router;
	}
}
