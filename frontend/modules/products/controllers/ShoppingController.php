<?php
namespace frontend\modules\products\controllers;
use Yii;
use yii\web\Controller;
class ShoppingController extends Controller{
    public function actionIndex(){
        $id = Yii::$app->request->post("id","");
        echo $id;
    }
}
