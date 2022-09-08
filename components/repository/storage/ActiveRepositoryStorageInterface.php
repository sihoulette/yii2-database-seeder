<?php

namespace app\components\repository\storage;

use yii\db\ActiveRecord;

/**
 * Interface ActiveRepositoryStorageInterface
 *
 * @package app\components\repository\storage
 */
interface ActiveRepositoryStorageInterface
{
    /**
     * @return ActiveRepositoryStorageInterface
     */
    public static function instance(): ActiveRepositoryStorageInterface;

    /**
     * Store created entity model
     *
     * @param ActiveRecord $model
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function create(ActiveRecord $model): ActiveRepositoryStorageProcessInterface;

    /**
     * Store edited entity model
     *
     * @param ActiveRecord $model
     */
    public function update(ActiveRecord $model): ActiveRepositoryStorageProcessInterface;

    /**
     * Delete entity model
     *
     * @param ActiveRecord $model
     */
    public function delete(ActiveRecord $model): ActiveRepositoryStorageProcessInterface;
}
