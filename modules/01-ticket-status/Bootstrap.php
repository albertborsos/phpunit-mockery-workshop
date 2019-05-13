<?php

namespace tickets;

use yii\base\Application;
use yii\console\controllers\MigrateController;

class Bootstrap
{
    const ALIAS = '@tickets';

    public static function setConfig(Application $app, $moduleId)
    {
        $app->setAliases([
            self::ALIAS => '@app/modules/01-ticket-status',
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
        $app->controllerMap['migrate']['migrationPath'][] = '@tickets/migrations';
    }

    private static function setCommonConfig(Application $app, $moduleId)
    {
        static::addUrlRules($app, $moduleId);
    }

    private static function addUrlRules(Application $app, $moduleId)
    {
        $app->urlManager->addRules([
            $moduleId => 'tickets/default/index',
        ]);
    }
}
