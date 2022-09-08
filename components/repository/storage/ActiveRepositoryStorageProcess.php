<?php

namespace app\components\repository\storage;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class ActiveRepositoryStorageProcess
 *
 * @package app\components\repository\storage
 */
abstract class ActiveRepositoryStorageProcess implements ActiveRepositoryStorageProcessInterface
{
    /**
     * @var bool $state
     */
    private bool $state = false;

    /**
     * @var array $logs
     */
    private array $errors = [];

    /**
     * @var string|null $type
     */
    protected ?string $type = null;

    /**
     * @var ActiveRecord $entityModel
     */
    protected ActiveRecord $entityModel;

    /**
     * @return bool
     */
    final public function getState(): bool
    {
        return $this->state;
    }

    /**
     * @return ActiveRecord
     */
    final public function getEntity(): ActiveRecord
    {
        return $this->entityModel;
    }

    /**
     * @param bool $state
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    final protected function commitState(bool $state): ActiveRepositoryStorageProcessInterface
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return array
     */
    final public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $message
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    final protected function writeError(string $message): ActiveRepositoryStorageProcessInterface
    {
        $this->errors[] = $message;

        return $this;
    }

    /**
     * @param array $messages
     *
     * @return ActiveRepositoryStorageProcessInterface
     */
    final protected function writeErrors(array $messages = []): ActiveRepositoryStorageProcessInterface
    {
        $this->errors = ArrayHelper::merge($this->errors, $messages);

        return $this;
    }
}
