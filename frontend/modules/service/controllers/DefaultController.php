<?php

namespace frontend\modules\service\controllers;

use yii\web\Controller;

/**
 * Default controller for the `service` module
 */
class DefaultController extends Controller
{
 
    public function actionIndex()
    {
        return $this->render('index');
    }
}
