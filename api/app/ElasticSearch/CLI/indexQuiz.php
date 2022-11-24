<?php

require __DIR__ . '/../../../vendor/autoload.php';
use App\Bootstrap;

$configurator = Bootstrap::boot();
$indexer = $configurator->createContainer()->getService("elasticSearch.tableIndexer");

dump($indexer->indexAll('quiz'));