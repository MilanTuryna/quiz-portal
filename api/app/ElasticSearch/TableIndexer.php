<?php


namespace App\ElasticSearch;


use App\Database\Entity\Quiz;
use App\Extensions\Elastica\Client;
use Elastica\Document;
use Nette\Database\Explorer;

/**
 * Class TableIndexer
 * @package App\ElasticSearch
 */
class TableIndexer
{
    private Explorer $explorer;
    private Client $client;

    /**
     * TableIndexer constructor.
     * @param Explorer $explorer
     * @param Client $client
     */
    public function __construct(Explorer $explorer, Client $client) {
        $this->explorer = $explorer;
        $this->client = $client;
    }

    /**
     * Table = Index!
     * @param string $table
     * @return int
     */
    public function indexAll(string $table): int
    {
        /**
         * @var $rows Quiz[]
         */
        $rows = $this->explorer->table($table)->fetchAll();
        $index = $this->client->getIndex($table);
        $mapping = $index->getMapping()['properties'];

        $documents = [];
        foreach	($rows as $row) {
            $data = [];
            foreach (array_keys($mapping) as $property) {
                if(isset($row->{$property})) {
                    $data[$property] = $row->{$property};
                }
            }
            $documents[] = new Document($row->id, $data);
        }
        $index->addDocuments($documents);
        $index->refresh();

        return count($rows);
    }
}