<?php

namespace App\Database\Repository;

use App\Database\Entity\User;
use App\Database\Repository;
use App\Database\Table;
use App\ElasticSearch\ElasticManager;
use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

/**
 * Class UserRepository
 * @package App\Database\Repository
 */
class UserRepository extends Repository
{
    private ElasticManager $elasticManager;

    /**
     * UserRepository constructor.
     * @param Explorer $explorer
     * @param ElasticManager $elasticManager
     */
    public function __construct(Explorer $explorer, ElasticManager $elasticManager)
    {
        parent::__construct(Table::USER, $explorer);

        $this->elasticManager = $elasticManager;
    }

    /**
     * @param string $nickname
     * @return array
     */
    public function search(string $nickname): array {
        if($this->elasticManager->getClient()->isEnabled()) return $this->elasticManager->multiMatch(Table::USER, $nickname, [User::nickname], 2);
        // without password, email (TODO: email only when user is authorized and it is him)
        $search = $this->explorer->query("SELECT nickname, date_created, hideFinishedQuizzes, points, id  FROM " . Table::USER . " WHERE match(". User::name .") AGAINST(?)", [$nickname])->fetchAll();
        return ["results" => $search];
    }

    /**
     * @param string|null $orderQuery
     * @return Selection
     */
    public function findAll(?string $orderQuery = null): Selection
    {
        return $this->findAll()->select("nickname, date_created, hideFinishedQuizzes, points, id");
    }
}