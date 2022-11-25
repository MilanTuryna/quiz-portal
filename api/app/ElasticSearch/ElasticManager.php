<?php


namespace App\ElasticSearch;

use Elastica\Search;
use Elastica\Query;
use App\Database\Table;
use App\Extensions\Elastica\Client;

/**
 * Class ElasticManager
 * @package App\ElasticSearch
 */
class ElasticManager
{
    private Client $client;

    /**
     * SearchManager constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Use DI rather
     * @return Client
     */
    public function getClient(): Client {
        return $this->client;
    }

    /**
     * @param string $index
     * @param string $searchedTerm
     * @param array $fields
     * @param int $fuzziness
     * @return array
     */
    public function multiMatch(string $index, string $searchedTerm, array $fields, int $fuzziness = 1): array {
        $search = new Search($this->client);
        $query = new Query();
        $search->addIndexByName($index);
        $result = [];
        if(strlen($searchedTerm) > 1) {
            $query->setRawQuery([
                'query' => [
                    "multi_match"=>[
                        "query" => $searchedTerm,
                        "fields" => $fields,
                        "fuzziness" => $fuzziness
                    ]
                ]
            ]);
            $search->setQuery($query);
            $result = $search->search()->getResponse()->getData();
        }
        return ElasticaUtils::formatSearch(Table::QUIZ, $result);
    }
}