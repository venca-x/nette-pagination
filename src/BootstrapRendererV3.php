<?php
declare(strict_types=1);

namespace VencaX\NettePagination;

class BootstrapRendererV3 extends AbstractBootstrapRenderer
{
	public function render()
	{
		$paginator = $this->getPaginator();
		$this->template->steps = $this->getSteps($paginator);
		$this->template->paginator = $paginator;
		$this->template->previousLabel = $this->previousLabel;
		$this->template->nextLabel = $this->nextLabel;
		$this->template->setFile(dirname(__FILE__) . '/bootstrapRendererV3.latte');
		$this->template->render();
	}
}
