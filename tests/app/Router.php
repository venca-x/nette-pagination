<?php
declare(strict_types=1);

namespace VencaX\Components\NettePaginator\Tests\App;

use Nette;


final class Router
{
	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$route = new Nette\Application\Routers\RouteList;
		$route[] = new Nette\Application\Routers\Route('<presenter>/<action>[/<id>]', 'Test:default');
		return $route;
	}
}
