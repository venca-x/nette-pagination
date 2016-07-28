<?php

namespace Tests;

use App;
use Nette;
use Tester;

require __DIR__ . '/bootstrap.php';

/**
 * @testCase
 */
class PaginationTest extends Tester\TestCase
{

	use \Testbench\TComponent;

	public function testRender()
	{
		$vp = new \NettePagination();
		$vp->setCount( 5 );
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 100;

		$this->checkRenderOutput($vp, __DIR__ . '/expected/base-paginator.phtml');
	}

}

(new PaginationTest)->run();