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
		$router[] = new ApiRoute("/users/search/<username>", "Users:search");
		$router[] = new ApiRoute("/users/find/<id>", "Users:find");
        $router[] = new ApiRoute("/users/find/<id>/reviews", "Users:findCategories"); // TODO: zkusit udělat i na withModule
        $router[] = new ApiRoute("/users/find/<id>/quizzes", "Users:findQuizzes");
        $router[] = new ApiRoute("/users/all/<pagination>", "Users:all");
        $router[] = new ApiRoute("/users/new", "Users:new");

        $router[] = new ApiRoute("/categories/all/<pagination>", "Categories:all");
        $router[] = new ApiRoute("/categories/find/<categoryName>", "Categories:find");
        $router[] = new ApiRoute("/categories/find/<categoryName>/quizzes", "Categories:findQuizzes");

        $router[] = new ApiRoute("/quizzes/search/<name>", "Quizzes:search");
        $router[] = new ApiRoute("/quizzes/all/<pagination>?orderBy=[<orderBy>]", "Quizzes:all");
        $router[] = new ApiRoute("/quizzes/find/<id>/categories", "Quizzes:findCategories");
        $router[] = new ApiRoute("/quizzes/find/<id>/questions", "Quizzes:findQuestions");
        $router[] = new ApiRoute("/quizzes/find/<id>/reviews", "Quizzes:findReviews");
        $router[] = new ApiRoute("/quizzes/find/<id>/tags", "Quizzes:findTags");
        $router[] = new ApiRoute("/quizzes/find/<id>", "Quizzes:find");

        $router[] = new ApiRoute("/reviews/all/<pagination>?orderBy=[<orderBy>]", "Reviews:all");
        $router[] = new ApiRoute("/reviews/find/<id>", "Reviews:find");

        $router[] = new ApiRoute("/questions/find/<id>", "Questions:find");

        $router[] = new ApiRoute("/tags/all/<pagination>", "Tags:all");
        $router[] = new ApiRoute("/tags/find/<tagName>", "Tags:find");

		return $router;
	}
}
