<?php
declare(strict_types=1);

namespace VencaX\Components\NettePaginator\Tests\Tests;

use Nette;
use Tester;
use VencaX;

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../app/Tbv4Presenter.php';
require_once __DIR__ . '/../app/Router.php';

class PaginationV3Test extends Tester\TestCase
{

	/** @var Nette\Application\IPresenterFactory */
	private $presenterFactory;

	/** @var Nette\DI\Container */
	private $container;

	private $presenter = 'Tbv4';


	/**
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->container = $this->createContainerX();
		$this->presenterFactory = $this->container->getByType('Nette\\Application\\IPresenterFactory');
	}


	/**
	 * @return void
	 */
	public function tearDown()
	{
		parent::tearDown();
	}


	/**
	 * @return Nette\DI\Container
	 */
	private function createContainerX()
	{
		$configurator = new Nette\Configurator();

		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/../app/config/config.neon');

		return $configurator->createContainer();
	}


	/**
	 * @return Nette\Application\IPresenter
	 */
	private function createPresenter()
	{
		$presenter = $this->presenterFactory->createPresenter($this->presenter);
		$presenter->autoCanonicalize = false;
		return $presenter;
	}


	/**
	 * @return void
	 */
	public function testGenerateContent()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET');
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();

		Tester\Assert::matchFile(__DIR__ . '/expected/' . $this->presenter . '/base-paginator.phtml', $html);
	}


	/**
	 * vp
	 * @return void
	 */
	public function testGVp()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET', ['action' => 'vp']);
		$response = $presenter->run($request);


		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();
		$dom = Tester\DomQuery::fromHtml($html);

		//Tester\Assert::same('', $html);
		Tester\Assert::count(9, $dom->find('li'));//approximately
	}


	/**
	 * Test paginator with one page
	 * @return void
	 */
	public function testGenerateContentOnePage()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET', ['action' => 'one']);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();

		Tester\Assert::same('', $html);
	}


	/**
	 * Test paginator with five pages
	 * @return void
	 */
	public function testGenerateContentFivePage()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET', ['action' => 'five']);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();
		$dom = Tester\DomQuery::fromHtml($html);

		//Tester\Assert::same('', $html);
		Tester\Assert::count(5, $dom->find('a[rel="next"]'));
		Tester\Assert::same('P', (string) $dom->find('li span')[0]);
		Tester\Assert::same('N', (string) $dom->find('a')[count($dom->find('a')) - 1]);
	}


	/**
	 * Test paginator with five pages
	 * @return void
	 */
	public function testGenerateContentTenPage()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET', ['action' => 'ten']);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();
		$dom = Tester\DomQuery::fromHtml($html);

		//Tester\Assert::same('', $html);
		Tester\Assert::count(10, $dom->find('a[rel="next"]'));
	}


	/**
	 * Test paginator with five pages
	 * @return void
	 */
	public function testGenerateContentFivehundredsPage()
	{
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request($this->presenter, 'GET', ['action' => 'fivehundreds']);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$html = (string) $response->getSource();
		$dom = Tester\DomQuery::fromHtml($html);

		//Tester\Assert::same('', $html);
		Tester\Assert::count(500, $dom->find('a[rel="next"]'));
	}


	public function testVP3()
	{
		//exception
		Tester\Assert::exception(function () {
			$vp = new VencaX\NettePagination\BootstrapRendererV4();
			$vp->setMaximalPagesCount(3);
		}, \Exception::class);
	}
}

$testCase = new PaginationV3Test;
$testCase->run();
