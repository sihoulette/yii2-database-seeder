<?php

namespace app\modules\cabinet;

use Yii;
use yii\filters\AccessControl;
use yii\base\Module as BaseModule;

/**
 * Class CabinetModule
 */
final class CabinetModule extends BaseModule
{
    /**
     * @var string $controllerNamespace
     */
    public $controllerNamespace = 'app\modules\cabinet\controllers';

    /**
     * @var string $defaultRoute
     */
    public $defaultRoute = 'dashboard';
}
