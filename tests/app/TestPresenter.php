<?php

namespace VencaX\Components\NettePaginator\Tests\App;

use Nette;
use VencaX;

require_once __DIR__ . "/../../src/NettePagination.php";

final class TestPresenter extends Nette\Application\UI\Presenter
{

    protected function createComponentVp()
    {
        $vp = new \NettePagination();
        $vp->setCount(5);
        $paginator = $vp->getPaginator();
        $paginator->itemsPerPage = 20;
        $paginator->itemCount = 100;

        return $vp;
    }

}
