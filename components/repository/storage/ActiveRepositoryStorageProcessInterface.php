<?php

namespace app\components\repository\storage;

use yii\db\ActiveRecord;

/**
 * Interface ActiveRepositoryStorageProcessInterface
 *
 * @package app\components\repository\storage
 */
interface ActiveRepositoryStorageProcessInterface
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
     * Storage process execution
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function execute(): ActiveRepositoryStorageProcessInterface;

    /**
     * Storage execution success state
     *
     * @return bool
     */
    public function getState(): bool;

    /**
     * Storage process entity model
     *
     * @return ActiveRecord
     */
    public function getEntity(): ActiveRecord;

    /**
     * Storage execution errors
     *
     * @return array
     */
    public function getErrors(): array;
}
