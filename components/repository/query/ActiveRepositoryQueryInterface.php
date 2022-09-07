<?php

namespace app\components\repository\query;

use yii\db\ActiveQuery;

/**
 * Interface ActiveRepositoryQueryInterface
 *
 * @package app\components\repository\query
 */
interface ActiveRepositoryQueryInterface
{
    /**
     * Create active repository query instance
     *
     * @return ActiveRepositoryQueryInterface
     */
    public static function instance(): ActiveRepositoryQueryInterface;

    /**
     * Setting entity class for building query
     *
     * @param string $class
     *
     * @return ActiveQuery
     */
    public function forClass(string $class): ActiveQuery;

    /**
     * Builder ActiveQuery instance
     *
     * @return ActiveQuery
     */
    public function builder(): ActiveQuery;

    /**
     * Reset ActiveQuery instance
     *
     * @return ActiveQuery
     */
    public function reset(): ActiveQuery;
}
