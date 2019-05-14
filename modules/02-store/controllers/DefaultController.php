<?php

namespace store\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['/store/offer/index']);
    }
}
