<?php

namespace app\components\repository\storage;

use Yii;
use Throwable;
use Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class ActiveRepositoryStorage
 *
 * @package app\components\repository\storage
 */
class ActiveRepositoryStorage implements ActiveRepositoryStorageInterface
{
    /**
     * @var array $logs
     */
    private array $logs = [];

    /**
     * @var ActiveRecord|null $entityModel
     */
    protected ?ActiveRecord $entityModel = null;

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
     * @return $this
     */
    final protected function setEntityModel(ActiveRecord $model): static
    {
        $this->entityModel = $model;

        return $this;
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function create(ActiveRecord $model): ?ActiveRecord
    {
        $log['success'] = false;
        $this->setEntityModel($model);
        if ($this->entityModel instanceof ActiveRecord && $this->entityModel->isNewRecord) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->entityModel->save();
                $transaction->commit();
                $log['success'] = true;
            } catch (Exception $e) {
                $log['exception'] = "[{$e->getCode()}] " . $e->getMessage();
                $transaction->rollBack();
            }
        }
        $this->setLog(__FUNCTION__, $log);

        return $log['success'] ? $this->entityModel : null;
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function update(ActiveRecord $model): ?ActiveRecord
    {
        $log['success'] = false;
        $this->setEntityModel($model);
        if ($this->entityModel instanceof ActiveRecord) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->entityModel->save();
                $transaction->commit();
                $log['success'] = true;
            } catch (Exception $e) {
                $log['success'] = false;
                $log['exception'] = "[{$e->getCode()}] " . $e->getMessage();
                $transaction->rollBack();
            }
        }
        $this->setLog(__FUNCTION__, $log);

        return $log['success'] ? $this->entityModel : null;
    }

    /**
     * @param ActiveRecord $model
     *
     * @return ActiveRecord|null
     */
    public function delete(ActiveRecord $model): ?ActiveRecord
    {
        $log['success'] = false;
        $this->setEntityModel($model);
        if ($this->entityModel instanceof ActiveRecord) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->entityModel->delete();
                $transaction->commit();
                $log['success'] = true;
            } catch (Throwable $e) {
                $log['success'] = false;
                $log['exception'] = "[{$e->getCode()}] " . $e->getMessage();
                $transaction->rollBack();
            }
        }
        $this->setLog(__FUNCTION__, $log);

        return $log['success'] ? $this->entityModel : null;
    }

    /**
     * @param string $type
     * @param array  $data
     *
     * @return void
     */
    final public function setLog(string $type, array $data = []): void
    {
        if (in_array($type, ActiveRepositoryStorageInterface::STORAGE_PROCESS, true)) {
            $this->logs[$type] = ArrayHelper::merge($this->logs[$type] ?? [], $data);
        }
    }

    /**
     * @param string $type
     *
     * @return array
     */
    final public function getLog(string $type): array
    {
        return $this->logs[$type] ?? [];
    }

    /**
     * @return array
     */
    final public function getLogs(): array
    {
        return $this->logs;
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
