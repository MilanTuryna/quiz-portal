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
		$router->addRoute("/api/", "Home:default");

		$router[] = new ApiRoute("/api/users/search/<username>", "Users:search");
		$router[] = new ApiRoute("/api/users/find/<id>", "Users:find");
        $router[] = new ApiRoute("/api/users/find/<id>/reviews", "Users:findCategories"); // TODO: zkusit udělat i na withModule
        $router[] = new ApiRoute("/api/users/find/<id>/quizzes", "Users:findQuizzes");
        $router[] = new ApiRoute("/api/users/all/<pagination>", "Users:all");
        $router[] = new ApiRoute("/api/users/new", "Users:new");

        $router[] = new ApiRoute("/api/categories/all/<pagination>", "Categories:all");
        $router[] = new ApiRoute("/api/categories/find/<categoryName>", "Categories:find");
        $router[] = new ApiRoute("/api/categories/find/<categoryName>/quizzes", "Categories:findQuizzes");

        $router[] = new ApiRoute("/api/quizzes/search/<name>", "Quizzes:search");
        $router[] = new ApiRoute("/api/quizzes/all/<pagination>?orderBy=[<orderBy>]", "Quizzes:all");
        $router[] = new ApiRoute("/api/quizzes/find/<id>/categories", "Quizzes:findCategories");
        $router[] = new ApiRoute("/api/quizzes/find/<id>/questions", "Quizzes:findQuestions");
        $router[] = new ApiRoute("/api/quizzes/find/<id>/reviews", "Quizzes:findReviews");
        $router[] = new ApiRoute("/api/quizzes/find/<id>/tags", "Quizzes:findTags");
        $router[] = new ApiRoute("/api/quizzes/find/<id>", "Quizzes:find");
        $router[] = new ApiRoute("/quizzes/new", "Quizzes:new");

        $router[] = new ApiRoute("/api/reviews/all/<pagination>?orderBy=[<orderBy>]", "Reviews:all");
        $router[] = new ApiRoute("/api/reviews/find/<id>", "Reviews:find");

        $router[] = new ApiRoute("/api/questions/find/<id>", "Questions:find");

        $router[] = new ApiRoute("/tags/all/<pagination>", "Tags:all");
        $router[] = new ApiRoute("/api/tags/find/<tagName>", "Tags:find");

		return $router;
	}
}
