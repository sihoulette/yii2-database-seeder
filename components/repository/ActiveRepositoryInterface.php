<?php

namespace app\components\repository;

use app\components\repository\query\ActiveRepositoryQueryInterface;
use app\components\repository\storage\ActiveRepositoryStorageInterface;

/**
 * Interface ActiveRepositoryInterface
 *
 * @package app\components\repository
 */
interface ActiveRepositoryInterface
{
    /**
     * Create active repository query instance
     *
     * @return ActiveRepositoryQueryInterface
     */
    public function getQuery(): ActiveRepositoryQueryInterface;

    /**
     * Create active repository storage instance
     *
     * @return ActiveRepositoryStorageInterface
     */
    public function getStorage(): ActiveRepositoryStorageInterface;
}
