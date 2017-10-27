<?php
declare(strict_types=1);

namespace VencaX\Components\NettePaginator\Tests\App;

use Nette;
use VencaX;

require_once __DIR__ . '/../../src/AbstractBootstrapRenderer.php';
require_once __DIR__ . '/../../src/BootstrapRendererV4.php';

final class Tbv4Presenter extends Nette\Application\UI\Presenter
{
	public function actionVp()
	{
		$vp = new VencaX\NettePagination\BootstrapRendererV4($this, 'vp');
		$vp->setMaximalPagesCount(5);//maximal count pages in paginator
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 1000;
	}


	protected function createComponentVp()
	{
		$vp = new VencaX\NettePagination\BootstrapRendererV4();
		$vp->setMaximalPagesCount(5);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 100;

		return $vp;
	}


	protected function createComponentVpOnePage()
	{
		$vp = new VencaX\NettePagination\BootstrapRendererV4();
		$vp->setMaximalPagesCount(5);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 20;

		return $vp;
	}


	protected function createComponentVp5()
	{
		//5 pages
		$vp = new VencaX\NettePagination\BootstrapRendererV4();
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
		//10 pages
		$vp = new VencaX\NettePagination\BootstrapRendererV4();
		$vp->setMaximalPagesCount(10);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}


	protected function createComponentVp500()
	{
		//500 pages
		$vp = new VencaX\NettePagination\BootstrapRendererV4();
		$vp->setMaximalPagesCount(500);
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 20;
		$paginator->itemCount = 10000;

		return $vp;
	}
}
