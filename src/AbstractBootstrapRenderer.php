<?php
declare(strict_types=1);

namespace VencaX\NettePagination;

use Nette;
use Nette\Application\UI\Control;
use Nette\Utils\Paginator;

abstract class AbstractBootstrapRenderer extends Control
{
	/** @persistent */
	public $page = 1;

	/** @var string */
	protected $previousLabel = '« Předchozí';

	/** @var string */
	protected $nextLabel = 'Další »';

	/** @var Paginator */
	private $paginator;

	/** @var int max pagen in paginator */
	private $maximalPagesCount = 10;


	/**
	 * AbstractBootstrapRenderer constructor.
	 * @param $parent
	 * @param $componentName
	 */
	public function __construct($parent = null, $componentName = null)
	{
		if ($parent != null && $componentName != null) {
			$parent->addComponent($this, $componentName);
		}
	}


	public function getPaginator(): Nette\Utils\Paginator
	{
		if (!$this->paginator) {
			$this->paginator = new Paginator;
		}
		return $this->paginator;
	}


	/**
	 * @return string
	 */
	public function getPreviousLabel(): string
	{
		return $this->previousLabel;
	}


	/**
	 * @param string $previousLabel
	 */
	public function setPreviousLabel(string $previousLabel)
	{
		$this->previousLabel = $previousLabel;
	}


	/**
	 * @return string
	 */
	public function getNextLabel(): string
	{
		return $this->nextLabel;
	}


	/**
	 * @param string $nextLabel
	 */
	public function setNextLabel(string $nextLabel)
	{
		$this->nextLabel = $nextLabel;
	}


	/**
	 * @return int
	 */
	public function getMaximalPagesCount(): int
	{
		return $this->maximalPagesCount;
	}


	/**
	 * Set maximal page count in paginator
	 * @param $count
	 */
	public function setMaximalPagesCount($count)
	{
		if ($count < 5) {
			throw new \Exception('Minimum value of MaximalPagesCount is 5');
		}
		$this->maximalPagesCount = $count;
	}


	protected function getSteps($paginator): array
	{
		$page = $paginator->page;
		if ($paginator->pageCount < 2) {
			$steps = [$page];
		} else {
			if ($this->getMaximalPagesCount() == 5) {
				$aroundActualPosition = 1;
			} elseif ($this->getMaximalPagesCount() <= 10) {
				$aroundActualPosition = 2;
			} else {
				$aroundActualPosition = 3;
			}

			$arr = range(max($paginator->firstPage, $page - $aroundActualPosition), min($paginator->lastPage, $page + $aroundActualPosition));
			$baseOffset = count($arr);
			if ($paginator->pageCount > $this->getMaximalPagesCount()) {
				//there is more page than limit
				$restPagesCount = $this->getMaximalPagesCount() - count($arr);
				$quotient = ($paginator->pageCount - 1) / $restPagesCount;
			} else {
				//show all pages
				$restPagesCount = $paginator->pageCount - count($arr);
				$quotient = 1;
			}

			for ($i = 0; $i < $restPagesCount; $i++) {
				$arr[] = round($baseOffset + ($quotient * $i)) + $paginator->firstPage;
			}
			sort($arr);
			$steps = array_values(array_unique($arr));
		}
		return $steps;
	}


	public function loadState(array $params): void
	{
		parent::loadState($params);
		$this->getPaginator()->page = $this->page;
	}
}
