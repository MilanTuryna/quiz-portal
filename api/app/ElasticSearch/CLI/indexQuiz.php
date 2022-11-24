<?php

require __DIR__ . '/../../../vendor/autoload.php';
use App\Bootstrap;

$configurator = Bootstrap::boot();
$indexer = $configurator->createContainer()->getService("elasticSearch.tableIndexer");
$table = 'quiz';
$indexer->setIndexName($table);
dump($indexer->indexAll($table));