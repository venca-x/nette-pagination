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

/** @var int shoved page in paginator */
private $paginatorOffset;

public function actionMy()
{
    $vp = new \NettePagination( $this, 'vp' );
    $vp->setCount( 5 );//change count of items in paginator
    $paginator = $vp->getPaginator();
    $paginator->itemsPerPage = 20;
    $paginator->itemCount = $this->modelTweets->findAll()->count( "*" );

    $this->paginatorOffset = $paginator->offset;

    $this->dataSelection = $this->modelTweets->findAll()->limit( $paginator->itemsPerPage, $paginator->offset );
    //...
}

public function renderMy()
{
    $this->template->paginatorOffset = $this->paginatorOffset;
}

```

Usage
-------------
On all pages of paginator (without first) use meta robots noindex,follow
```php
    {block head}
        {if $paginatorOffset > 1}
            <meta name="robots" content="noindex,follow">
        {/if}
    {/block}

    {block content}
        ...
        {control vp}
        ...
    {/block}
```