Nette-pagination
===============
[![Build Status](https://travis-ci.org/venca-x/nette-pagination.svg)](https://travis-ci.org/venca-x/nette-pagination) 
[![Latest Stable Version](https://poser.pugx.org/venca-x/nette-pagination/v/stable.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![Total Downloads](https://poser.pugx.org/venca-x/nette-pagination/downloads.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![Latest Unstable Version](https://poser.pugx.org/venca-x/nette-pagination/v/unstable.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![License](https://poser.pugx.org/venca-x/nette-pagination/license.svg)](https://packagist.org/packages/venca-x/nette-pagination)

Plugin for Nette. Pagination wit style Twitter Bootstrap 3

Installation
------------

1. Add the bundle to your dependencies:

install with composer:
```js
composer require venca-x/nette-pagination
```

or add line to composer.json:
```js
// composer.json
{
    // ...
    "require": {
        // ...
        "venca-x/nette-pagination": "@dev",
    }
}
```
2. Use Composer to download and install the bundle:
```js
composer update
```
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
```html
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
