<?php
declare(strict_types=1);

namespace VencaX\Components\NettePaginator\Tests\App;

use Nette;
use VencaX;

require_once __DIR__ . '/../../src/AbstractBootstrapRenderer.php';
require_once __DIR__ . '/../../src/BootstrapRendererV3.php';

final class Tbv3Presenter extends Nette\Application\UI\Presenter
{
	public function actionVp()
	{
		$vp = new VencaX\NettePagination\BootstrapRendererV3($this, 'vp');
		$vp->setMaximalPagesCount(5);//maximal count pages in paginator
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 1000;
	}


	protected function createComponentVp()
	{
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setMaximalPagesCount(5);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 100;

		return $vp;
	}


	protected function createComponentVpOnePage()
	{
		//noje pages, all on one
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setMaximalPagesCount(5);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 20;

		return $vp;
	}


	protected function createComponentVp3()
	{
		//exception, minimum pages is 5
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setMaximalPagesCount(3);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}


	protected function createComponentVp5()
	{
		//5 pages
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setPreviousLabel('P');
		if ($vp->getPreviousLabel() != 'P') {
			throw new \Exception('Problem');
		}
		$vp->setNextLabel('N');
		if ($vp->getNextLabel() != 'N') {
			throw new \Exception('Problem');
		}
		$vp->setMaximalPagesCount(5);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}


	protected function createComponentVp10()
	{
		//noje pages, all on one
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setMaximalPagesCount(10);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}


	protected function createComponentVp500()
	{
		//noje pages, all on one
		$vp = new VencaX\NettePagination\BootstrapRendererV3();
		$vp->setMaximalPagesCount(500);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}
}
