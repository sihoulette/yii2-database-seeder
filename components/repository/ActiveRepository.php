<?php

namespace app\components\repository;

use yii\base\Component;
use app\components\repository\query\ActiveRepositoryQuery;
use app\components\repository\storage\ActiveRepositoryStorage;
use app\components\repository\query\ActiveRepositoryQueryInterface;
use app\components\repository\storage\ActiveRepositoryStorageInterface;

/**
 * Class ActiveRepository
 *
 * @package app\components\repository
 */
class ActiveRepository extends Component implements ActiveRepositoryInterface
{
    /**
     * @var ActiveRepositoryQueryInterface|null $query
     */
    protected ?ActiveRepositoryQueryInterface $query = null;

    /**
     * @var ActiveRepositoryStorageInterface|null $storage
     */
    protected ?ActiveRepositoryStorageInterface $storage = null;

    /**
     * @return ActiveRepositoryQueryInterface
     */
    public function getQuery(): ActiveRepositoryQueryInterface
    {
        $this->query = ActiveRepositoryQuery::instance();

        return $this->query;
    }

    /**
     * @return ActiveRepositoryStorageInterface
     */
    public function getStorage(): ActiveRepositoryStorageInterface
    {
        $this->storage = ActiveRepositoryStorage::instance();

        return $this->storage;
    }
}
