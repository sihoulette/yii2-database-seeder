<?php

namespace app\modules\cabinet\controllers;

use yii\web\Controller;

/**
 * Class DashboardController
 *
 * @package app\modules\cabinet\controllers
 */
final class DashboardController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
