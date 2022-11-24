<?php


namespace App\ElasticSearch;


use Contributte\Elastica\Client;
use Nette\Database\Explorer;

/**
 * Class TableIndexer
 * @package App\ElasticSearch
 */
class TableIndexer
{
    private string $indexName;
    private Explorer $explorer;
    private Client $client;

    /**
     * TableIndexer constructor.
     * @param Settings $settings
     * @param Explorer $explorer
     * @param Client $client
     */
    public function __construct(Settings $settings, Explorer $explorer, Client $client) {
        $this->explorer = $explorer;
        $this->client = $client;
        $this->indexName = $settings->getIndex();
    }

    /**
     * @param string $indexName
     */
    public function setIndexName(string $indexName): void {
        $this->indexName = $indexName;
    }

    /**
     * @param string $table
     * @return int
     */
    public function indexAll(string $table): int
    {
        $rows = $this->explorer->table($table)->fetchAll();
        $index = $this->client->getIndex($this->indexName);
        foreach	($rows as $row) {
            $index->create([
                'type' => $table,
                'id' => $row['id'],
                'body' => $row->toArray()
            ]);
        }

        return count($rows);
    }
}