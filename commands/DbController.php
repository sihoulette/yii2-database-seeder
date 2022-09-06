<?php

namespace app\commands;

use app\components\seeder\SeederComponent;
use yii\base\Module as BaseModule;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class DbController
 *
 * @package app\commands
 */
class DbController extends Controller
{
    /**
     * @var SeederComponent $seeder
     */
    protected SeederComponent $seeder;

    /**
     * @param string          $id
     * @param BaseModule      $module
     * @param SeederComponent $seeder
     * @param array           $config
     */
    public function __construct(string $id, BaseModule $module, SeederComponent $seeder, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->seeder = $seeder;
    }

    /**
     * @param string|null $id
     *
     * @return int
     */
    public function actionSeed(string $id = null): int
    {
        $seeder = !empty($id)
            ? $this->seeder->callOne($id)
            : $this->seeder->callAll();
        array_filter($seeder->getLog(), static function (array $state, string $seeder) {
            $message = $state['success'] ?? false
                ? "\033[32mDONE \033[0m" : "\033[31mFAILED \033[0m";
            echo $seeder . '..................' . $message . PHP_EOL;
        }, ARRAY_FILTER_USE_BOTH);

        return ExitCode::OK;
    }
}
