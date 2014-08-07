nette-pagination
===============

Plugin for Nette. Pagination with TB3

Installation
------------

 1. Add the bundle to your dependencies:

        // composer.json

        {
           // ...
           "require": {
               // ...
			   "venca-x/nette-pagination": "@dev",
           }
        }

 2. Use Composer to download and install the bundle:

        composer update

Configuration
-------------

HomepagePresenter.php

```php

public function actionMy()
{
	$vp = new \NettePagination( $this, 'vp' );
	$paginator = $vp->getPaginator();
	$paginator->itemsPerPage = 20;
	$paginator->itemCount = $this->modelTweets->findAll()->count( "*" );
	
	$this->dataSelection = $this->modelTweets->findAll()->limit( $paginator->itemsPerPage, $paginator->offset );
	//..
}

```

Usage
-------------

```php
{control vp}

```