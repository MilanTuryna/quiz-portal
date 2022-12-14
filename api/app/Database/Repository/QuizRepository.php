<?php

namespace App\Database\Repository;

use App\Database\Entity\Quiz;
use App\Database\Table;
use App\Database\Repository;
use App\ElasticSearch\ElasticManager;
use Nette\Database\Explorer;

/**
 * Class QuizRepository
 * @package App\Database\Repository
 */
class QuizRepository extends Repository
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
        if($this->elasticManager->getClient()->isEnabled()) return $this->elasticManager->multiMatch(Table::QUIZ, $name, [Quiz::name], 2);
        $search = $this->explorer->query("SELECT * FROM " . Table::QUIZ . " WHERE match(". Quiz::name .") AGAINST(?)", [$name])->fetchAll();
        return ["results" => $search];
    }
}