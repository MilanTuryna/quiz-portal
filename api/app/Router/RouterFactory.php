<?php

declare(strict_types=1);

namespace App\Router;

use Contributte\ApiRouter\ApiRoute;
use Nette;
use Nette\Application\Routers\RouteList;

/**
 * Class RouterFactory
 * @package App\Router
 */
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
		$router->addRoute("/api", "Home:default");

		$router[] = new ApiRoute("/users/search/<username>", "Users:search");
		$router[] = new ApiRoute("/users/find/<id>", "Users:find");
        $router[] = new ApiRoute("/users/find/<id>/reviews", "Users:findCategories"); // TODO: zkusit udělat i na withModule
        $router[] = new ApiRoute("/users/find/<id>/quizzes", "Users:findQuizzes");
        $router[] = new ApiRoute("/users/all/<pagination>", "Users:all");
        $router[] = new ApiRoute("/users/new", "Users:new");

        $router[] = new ApiRoute("/categories/all[/<page>]", "Categories:all");
        $router[] = new ApiRoute("/categories/find/<id>", "Categories:find"); // it's possible to send category name instead id

        $router[] = new ApiRoute("/<table>/find/<id>/<related>[/<page>]", "FindRelated");

        $router->withModule("Quizzes") // ApiRoute doesn't support spaces (%20) and some special characters in URL
            ->addRoute("/api/quizzes/all[/<page>]?order=[<order>]", "All:read")
            ->addRoute("/api/quizzes/search/<name>", "Search:read");
        $router[] = new ApiRoute("/quizzes/find/<id>", "Quizzes:find");
        $router[] = new ApiRoute("/quiz/new", "Quizzes:new");

        $router[] = new ApiRoute("/reviews/all/<pagination>?orderBy=[<orderBy>]", "Reviews:all");
        $router[] = new ApiRoute("/reviews/find/<id>", "Reviews:find");

        $router[] = new ApiRoute("/questions/find/<id>", "Questions:find");

        $router[] = new ApiRoute("/tags/all[/<page>]", "Tags:all");
        $router[] = new ApiRoute("/tags/find/<id>", "Tags:find");


		return $router;
	}
}