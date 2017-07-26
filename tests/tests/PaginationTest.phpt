<?php

namespace VencaX\Components\NettePaginator\Tests\Tests;

use VencaX;
use Nette;
use Tester;

require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__ . "/../app/TestPresenter.php";
require_once __DIR__ . "/../app/Router.php";

class PaginationTest extends Tester\TestCase
{

    /** @var Nette\Application\IPresenterFactory */
    private $presenterFactory;

    /** @var Nette\DI\Container */
    private $container;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->container = $this->createContainerX();
        $this->presenterFactory = $this->container->getByType("Nette\\Application\\IPresenterFactory");
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
        $configurator->addConfig(__DIR__ . "/../app/config/config.neon");

        return $configurator->createContainer();
    }

    /**
     * @return Nette\Application\IPresenter
     */
    private function createPresenter()
    {
        $presenter = $this->presenterFactory->createPresenter("Test");
        $presenter->autoCanonicalize = FALSE;
        return $presenter;
    }

    /**
     * @return void
     */
    public function testGenerateContent()
    {

        $presenter = $this->createPresenter();
        $request = new Nette\Application\Request("Test", "GET");
        $response = $presenter->run($request);

        Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

        $html = (string)$response->getSource();

        Tester\Assert::matchFile(__DIR__ . '/expected/base-paginator.phtml', $html);
    }

}
$testCase = new PaginationTest;
$testCase->run();