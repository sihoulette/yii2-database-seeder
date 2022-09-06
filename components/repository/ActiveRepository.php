<?php

namespace app\components\repository;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\base\Component;

/**
 * Class ActiveRepository
 *
 * @package app\components\repository
 */
class ActiveRepository extends Component implements ActiveRepositoryInterface
{
    /**
     * @var string $modelClass
     */
    protected string $modelClass = ActiveRecord::class;

    /**
     * @var ActiveQuery $query
     */
    private ActiveQuery $query;

    /**
     * @var ActiveRecord $entity
     */
    protected ActiveRecord $entity;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->newQuery();
    }

    /**
     * @return ActiveQuery
     */
    final public function newQuery(): ActiveQuery
    {
        $this->query = new ActiveQuery($this->modelClass);

        return $this->getQuery();
    }

    /**
     * @return ActiveQuery
     */
    final public function getQuery(): ActiveQuery
    {
        return $this->query;
    }
}
