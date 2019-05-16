<?php

namespace app\modules\base\commands;

use app\modules\base\models\Seeder;
use yii\console\Controller;

class SeederController extends Controller
{
    public function actionIndex()
    {
        return Seeder::run();
    }
}
