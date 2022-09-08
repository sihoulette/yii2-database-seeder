<?php

namespace app\components\repository\storage\process;

use Yii;
use Exception;
use yii\db\ActiveRecord;
use app\components\repository\storage\ActiveRepositoryStorageProcess;
use app\components\repository\storage\ActiveRepositoryStorageProcessInterface;

/**
 * Class ActiveRepositoryStorageProcessUpdate
 *
 * @package app\components\repository\storage\process
 */
class ActiveRepositoryStorageProcessUpdate extends ActiveRepositoryStorageProcess
{
    /**
     * @var string|null $type
     */
    protected ?string $type = ActiveRepositoryStorageProcessInterface::PROCESS_UPDATE;

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
            $this->entityModel->save();
            $transaction->commit();
            $this->commitState(true);
        } catch (Exception $e) {
            $transaction->rollBack();
            $this->commitState(false);
            $this->writeError("[{$e->getCode()}] " . $e->getMessage());
        }

        return $this;
    }
}
