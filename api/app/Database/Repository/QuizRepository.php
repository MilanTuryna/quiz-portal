<?php

namespace App\Database\Repository;

use App\Database\Table;
use App\ElasticSearch\AbstractRepository;
use App\ElasticSearch\ElasticaUtils;
use App\Http\ResponseFormatter;
use Contributte\Elastica\Client;
use Nette\Database\Explorer;
use Elastica;

/**
 * Class QuizRepository
 * @package App\Database\Repository
 */
class QuizRepository extends AbstractRepository
{
    private Client $esClient;

    /**
     * QuizRepository constructor.
     * @param Explorer $explorer
     * @param Client $esClient
     * @param ResponseFormatter $responseFormatter
     */
    public function __construct(Explorer $explorer, Client $esClient, ResponseFormatter $responseFormatter)
    {
        parent::__construct(Table::QUIZ, $explorer);

        $this->esClient = $esClient;
    }

    /**
     * @param string $name
     * Maybe add as filtered term description also
     */
    public function search(string $name): array {
        $search = new Elastica\Search($this->esClient);
        $query = [
            'index' => 'quiz-portal',
            'type' => Table::QUIZ,
            'body' => [
                'query' => [
                    'filtered' => [
                        'term' => [
                            'name' => $name
                        ]
                    ]
                ]
            ]
        ];
        $result = $search->setQuery($query)->getQuery()->toArray();
        return ElasticaUtils::formatSearch(Table::QUIZ, $result);
    }
}