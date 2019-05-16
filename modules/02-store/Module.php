<?php

namespace store;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    const CLOSE_AT_BY_DAY_NUM = [
        1 => '17:00',
        2 => '17:00',
        3 => '17:00',
        4 => '17:00',
        5 => '17:00',
        6 => '14:00',
        7 => null,
    ];

    public function init()
    {
        parent::init();
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'store\commands';
        }
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        Bootstrap::setConfig($app, $this->id);
    }
}
