<?php

namespace billing;

use yii\base\Application;
use yii\console\controllers\MigrateController;

class Bootstrap
{
    const ALIAS = '@billing';

    public static function setConfig(Application $app, $moduleId)
    {
        $app->setAliases([
            self::ALIAS => '@app/modules/03-billing',
        ]);

        static::setCommonConfig($app, $moduleId);
        static::setConsoleConfig($app);
    }

    protected static function setConsoleConfig(Application $app)
    {
        if (!$app instanceof \yii\console\Application) {
            return;
        }

        static::addMigrationPath($app);
    }

    /**
     * @param Application $app
     */
    protected static function addMigrationPath(Application $app): void
    {
        if (!isset($app->controllerMap['migrate']['class'])) {
            $app->controllerMap['migrate']['class'] = MigrateController::class;
        }
        $app->controllerMap['migrate']['migrationPath'][] = '@billing/migrations';
    }

    private static function setCommonConfig(Application $app, $moduleId)
    {
        static::addUrlRules($app, $moduleId);
    }

    private static function addUrlRules(Application $app, $moduleId)
    {
        $app->urlManager->addRules([
            $moduleId => 'billing/default/index',
        ]);
    }
}
