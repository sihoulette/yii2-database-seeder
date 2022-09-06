<?php

namespace app\components\repository;

use yii\db\ActiveQuery;

/**
 * Interface ActiveRepositoryInterface
 *
 * @package app\components\repository
 */
interface ActiveRepositoryInterface
{
    /**
     * @return ActiveQuery
     */
    public function newQuery(): ActiveQuery;

    /**
     * @return ActiveQuery
     */
    public function getQuery(): ActiveQuery;
}
