<?php

namespace app\components\repository\query;

use Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class ActiveRepositoryQuery
 *
 * @package app\components\repository\query
 */
class ActiveRepositoryQuery implements ActiveRepositoryQueryInterface
{
    /**
     * @var ActiveQuery|null $query
     */
    private ?ActiveQuery $query = null;

    /**
     * @var string $entityClass
     */
    protected static string $entityClass = ActiveRecord::class;

    /**
     * @var array $instances
     */
    private static array $instances = [];

    /**
     * Close constructor for singleton
     */
    protected function __construct()
    {
    }

    /**
     * @return ActiveRepositoryQueryInterface
     */
    public static function instance(): ActiveRepositoryQueryInterface
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
            self::$instances[$class]->reset();
        }

        return self::$instances[$class];
    }

    /**
     * @param string $class
     *
     * @return ActiveQuery
     */
    final public function forClass(string $class): ActiveQuery
    {
        if (is_a($class, ActiveRecord::class, true)) {
            self::$entityClass = $class;
        }

        return $this->builder();
    }

    /**
     * @return ActiveQuery
     */
    final public function builder(): ActiveQuery
    {
        if ($this->query->modelClass !== static::$entityClass) {
            $this->query->modelClass = static::$entityClass;
        }

        return $this->query instanceof ActiveQuery
            ? $this->query : $this->reset();
    }

    /**
     * @return ActiveQuery
     */
    final public function reset(): ActiveQuery
    {
        $this->query = new ActiveQuery(static::$entityClass);

        return $this->query;
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
