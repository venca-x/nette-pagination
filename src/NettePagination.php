<?php

use Nette\Application\UI\Control;
use Nette\Utils\Paginator;

class NettePagination extends Control
{

    /** @var Paginator */
    private $paginator;

    /** @persistent */
    public $page = 1;

    public function getPaginator()
    {
        if ( !$this->paginator )
        {
            $this->paginator = new Paginator;
        }
        return $this->paginator;
    }

    public function render()
    {
        $paginator = $this->getPaginator();
        $page = $paginator->page;
        if ( $paginator->pageCount < 2 )
        {
            $steps = array( $page );
        }
        else
        {
            $arr = range( max( $paginator->firstPage, $page - 3 ), min( $paginator->lastPage, $page + 3 ) );
            $count = 10;
            $quotient = ($paginator->pageCount - 1) / $count;
            for ( $i = 0; $i <= $count; $i++ )
            {
                $arr[] = round( $quotient * $i ) + $paginator->firstPage;
            }
            sort( $arr );
            $steps = array_values( array_unique( $arr ) );
        }

        $this->template->steps = $steps;
        $this->template->paginator = $paginator;
        $this->template->setFile( dirname( __FILE__ ) . '/NettePagination.latte' );
        $this->template->render();
    }

    public function loadState( array $params )
    {
        parent::loadState( $params );
        $this->getPaginator()->page = $this->page;
    }

}
