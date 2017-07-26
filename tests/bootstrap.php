<?php

require __DIR__ . '/../vendor/autoload.php';
/*
(new \Nette\Loaders\RobotLoader())
	->setCacheStorage(new \Nette\Caching\Storages\FileStorage(__DIR__ . '/temp'))
	->addDirectory([__DIR__ . '/../src'])
	->register();
*/
if (!class_exists('Tester\Assert')) {
    echo "Install Nette Tester using `composer update --dev`\n";
    exit(1);
}

/*
Testbench\Bootstrap::setup(__DIR__ . '/temp', function (\Nette\Configurator $configurator) {
	$configurator->addParameters([
		'appDir' => __DIR__ . '/../src',
	]);
});
*/