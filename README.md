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
	$this->paginator = $vp->getPaginator();
	$this->paginator->itemsPerPage = 20;
	$this->paginator->itemCount = $this->modelTweets->findAll()->count( "*" );
	
	//..
}

```

Usage
-------------

```php
{control vp}

```