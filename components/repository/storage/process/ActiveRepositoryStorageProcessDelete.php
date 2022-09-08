<?php

namespace app\components\repository\storage\process;

use Yii;
use Throwable;
use yii\db\ActiveRecord;
use app\components\repository\storage\ActiveRepositoryStorageProcess;
use app\components\repository\storage\ActiveRepositoryStorageProcessInterface;

/**
 * Class ActiveRepositoryStorageProcessDelete
 *
 * @package app\components\repository\storage\process
 */
class ActiveRepositoryStorageProcessDelete extends ActiveRepositoryStorageProcess
{
    /**
     * @var string|null $type
     */
    protected ?string $type = ActiveRepositoryStorageProcessInterface::PROCESS_DELETE;

    /**
     * @param ActiveRecord $entityModel
     */
    public function __construct(ActiveRecord $entityModel)
    {
        $this->entityModel = $entityModel;
    }

    /**
     * @return ActiveRepositoryStorageProcessInterface
     */
    public function execute(): ActiveRepositoryStorageProcessInterface
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->entityModel->delete();
            $transaction->commit();
            $this->commitState(true);
        } catch (Throwable $e) {
            $transaction->rollBack();
            $this->commitState(false);
            $this->writeError("[{$e->getCode()}] " . $e->getMessage());
        }

        return $this;
    }
}
