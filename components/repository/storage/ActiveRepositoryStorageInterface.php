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
    // Activity process of create
    public const PROCESS_CREATE = 'create';

    // Activity process of update
    public const PROCESS_UPDATE = 'update';

    // Activity process of delete
    public const PROCESS_DELETE = 'delete';

    // List of storage activity process
    public const STORAGE_PROCESS = [
        self::PROCESS_CREATE, self::PROCESS_UPDATE, self::PROCESS_DELETE
    ];

    /**
     * @return ActiveRepositoryStorageInterface
     */
    public static function instance(): ActiveRepositoryStorageInterface;

    /**
     * Store created entity model
     *
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function create(ActiveRecord $model): ?ActiveRecord;

    /**
     * Store edited entity model
     *
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function update(ActiveRecord $model): ?ActiveRecord;

    /**
     * Delete entity model
     *
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function delete(ActiveRecord $model): ?ActiveRecord;

    /**
     * @param string $type
     * @param array  $data
     *
     * @return void
     */
    public function setLog(string $type, array $data = []): void;

    /**
     * @param string $type
     *
     * @return array
     */
    public function getLog(string $type): array;

    /**
     * @return array
     */
    public function getLogs(): array;
}
