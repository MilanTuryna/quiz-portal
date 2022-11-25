<?php

namespace App\Database\Repository;

use App\Database\Table;
use App\ElasticSearch\AbstractRepository;
use App\ElasticSearch\ElasticManager;
use App\ElasticSearch\Entity\SearchedQuiz;
use Nette\Database\Explorer;

/**
 * Class QuizRepository
 * @package App\Database\Repository
 */
class QuizRepository extends AbstractRepository
{
    private ElasticManager $elasticManager;

    /**
     * QuizRepository constructor.
     * @param Explorer $explorer
     * @param ElasticManager $elasticManager
     */
    public function __construct(Explorer $explorer, ElasticManager $elasticManager)
    {
        parent::__construct(Table::QUIZ, $explorer);

        $this->elasticManager = $elasticManager;
    }

    /**
     * @param string $name
     * Maybe add as filtered term description also
     */
    public function search(string $name): array {
        if($this->elasticManager->getClient()->isEnabled()) return $this->elasticManager->multiMatch(Table::QUIZ, $name, [SearchedQuiz::name], 2);
        $search = $this->explorer->query("SELECT * FROM " . Table::QUIZ . " WHERE match(". SearchedQuiz::name .") AGAINST(?)", [$name])->fetchPairs();
        return Table::toJSON(Table::QUIZ, $search);
    }
}