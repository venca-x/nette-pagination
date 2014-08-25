<?php

namespace Test;

use Nette,
	Tester,
	Tester\Assert;

$container = require __DIR__ . '/bootstrap.php';


class ExampleTest extends Tester\TestCase
{
	private $container;


	function __construct(Nette\DI\Container $container)
	{
		$this->container = $container;
	}


	function setUp()
	{
	}


	function testDummy()
	{
		Assert::true( true );
	}
/*
	function testPagination()
	{
		$vp = new \NettePagination( $this->container, 'vp' );
		//$paginator = $vp->getPaginator();
		//$paginator->itemsPerPage = 20;
		//$paginator->itemCount = $this->modelTweets->findAll()->count( "*" );

		//$this->dataSelection = $this->modelTweets->findAll()->limit( $paginator->itemsPerPage, $paginator->offset );	
	}
*/
}


$test = new ExampleTest($container);
$test->run();
