<?php

namespace app\components\repository\storage;

use Exception;
use yii\db\ActiveRecord;
use app\components\repository\storage\process\ActiveRepositoryStorageProcessCreate;
use app\components\repository\storage\process\ActiveRepositoryStorageProcessUpdate;
use app\components\repository\storage\process\ActiveRepositoryStorageProcessDelete;

/**
 * Class ActiveRepositoryStorage
 *
 * @package app\components\repository\storage
 */
class ActiveRepositoryStorage implements ActiveRepositoryStorageInterface
{
    /**
     * @var array $instances
     */
    private static array $instances = [];

    /**
     * @var ActiveRepositoryStorageProcessInterface|null $process
     */
    private ?ActiveRepositoryStorageProcessInterface $process = null;

    /**
     * Close constructor for singleton
     */
    protected function __construct()
    {
    }

    /**
     * @return ActiveRepositoryStorageInterface
     */
    public static function instance(): ActiveRepositoryStorageInterface
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function create(ActiveRecord $model): ActiveRepositoryStorageProcessInterface
    {
        $this->process = new ActiveRepositoryStorageProcessCreate($model);

        return $this->process->execute();
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function update(ActiveRecord $model): ActiveRepositoryStorageProcessInterface
    {
        $this->process = new ActiveRepositoryStorageProcessUpdate($model);

        return $this->process->execute();
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function delete(ActiveRecord $model): ActiveRepositoryStorageProcessInterface
    {
        $this->process = new ActiveRepositoryStorageProcessDelete($model);

        return $this->process->execute();
    }

    /**
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a object.");
    }
}
