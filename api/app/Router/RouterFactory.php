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

		$router[] = new ApiRoute("/users/search/<username>", "Users:search"); // TODO: zlepšit systém vyhledávání
		$router[] = new ApiRoute("/users/find/<id>", "Users:find");
        $router[] = new ApiRoute("/users/all[/<page>]", "Users:all");
        // todo
        $router[] = new ApiRoute("/users/new", "Users:new");

        $router[] = new ApiRoute("/categories/all[/<page>]", "Categories:all");
        $router[] = new ApiRoute("/categories/find/<id>", "Categories:find"); // it's possible to send category name instead id

        $router[] = new ApiRoute("/<table>/find/<id>/<related>[/<page>]", "FindRelated");

        $router->withModule("Quizzes") // ApiRoute doesn't support spaces (%20) and some special characters in URL
            ->addRoute("/api/quizzes/all[/<page>]?order=[<order>]", "All:read") // maybe sql security problem
            ->addRoute("/api/quizzes/search/<name>", "Search:read");
        $router[] = new ApiRoute("/quizzes/find/<id>", "Quizzes:find");

        $router[] = new ApiRoute("/quiz/new", "Quizzes:new");
        $router->withModule("Reviews")
            ->addRoute("/api/reviews/all[/<page>]?orderBy=[<orderBy>]", "All:read");
        $router[] = new ApiRoute("/reviews/find/<id>", "Reviews:find");

        $router[] = new ApiRoute("/questions/find/<id>", "Questions:find");

        $router[] = new ApiRoute("/tags/all[/<page>]", "Tags:all");
        $router[] = new ApiRoute("/tags/find/<id>", "Tags:find");


		return $router;
	}
}