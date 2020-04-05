Nette pagination Twitter Bootrstrap
===============
[![Build Status](https://travis-ci.org/venca-x/nette-pagination.svg)](https://travis-ci.org/venca-x/nette-pagination)
[![Coverage Status](https://coveralls.io/repos/github/venca-x/nette-pagination/badge.svg?branch=master)](https://coveralls.io/github/venca-x/nette-pagination?branch=master) 
[![Latest Stable Version](https://poser.pugx.org/venca-x/nette-pagination/v/stable.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![Latest Unstable Version](https://poser.pugx.org/venca-x/nette-pagination/v/unstable.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![Total Downloads](https://poser.pugx.org/venca-x/nette-pagination/downloads.svg)](https://packagist.org/packages/venca-x/nette-pagination) 
[![License](https://poser.pugx.org/venca-x/nette-pagination/license.svg)](https://packagist.org/packages/venca-x/nette-pagination)

Plugin for Nette. Pagination with Twitter Bootstrap style Twitter Bootstrap
Suports Twitter Bootstrap 3 and Twitter Bootstrap 4

| Version     | Twitter&nbsp;Bootstrap&nbsp;version | PHP&nbsp;&nbsp;&nbsp;     | Recommended&nbsp;Nette |
| ---         | ---                                 | ---                       | ---               |
| dev-master  | 4, 3                                | \>= 7.1                   | Nette 3.0         |
| 0.1.x       | 3                                   | \>= 5.5                   | Nette 2.4, 2.3    |

Installation
------------
install with composer:
```
composer require venca-x/nette-pagination:dev-master
```

### Nette 3.0
For Nette 3.0 (and PHP >= 7.1) use:
```
composer require venca-x/nette-pagination:^1.0
//or
composer require venca-x/nette-pagination:dev-master
```
For Nette 2.4. and 2.3 use:
```
composer require venca-x/nette-pagination:^0.1
```


Configuration
-------------

HomepagePresenter.php

```php
/** @var int shoved page in paginator */
private $paginatorOffset;

public function actionMy()
{
    $vp = new VencaX\NettePagination\BootstrapRendererV4();
    $vp->setMaximalPagesCount( 5 );//maximal count pages in paginator
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

Tips
-------------
**How to change labels « Předchozí and Další »?**

Change it in the constructor:
```php
$vp = new VencaX\NettePagination\BootstrapRendererV4();
$vp->setPreviousLabel('«');
$vp->setNextLabel('»');
//or
$vp = new VencaX\NettePagination\BootstrapRendererV3();
$vp->setPreviousLabel('«');
$vp->setNextLabel('»');
```

TwitterBootstrap v3
-------------
How to use for TwitterBootstrap v3?

Usage is same as TwitterBootstrap v4. Only chnage class to **VencaX\NettePagination\BootstrapRendererV3**
```php
/** @var int shoved page in paginator */
private $paginatorOffset;

public function actionMy()
{
    $vp = new VencaX\NettePagination\BootstrapRendererV3();
    $vp->setMaximalPagesCount( 5 );//maximal count pages in paginator
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