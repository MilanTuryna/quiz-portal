<?php

declare(strict_types=1);

use Apitte\Core\Application\IApplication;

require __DIR__ . '/../vendor/autoload.php';

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(IApplication::class);
$application->run();
