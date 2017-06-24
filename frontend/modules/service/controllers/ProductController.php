<?php
namespace frontend\modules\service\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Json;
 
class ProductController extends Controller{
    public $enableCsrfValidation=false;
    public function actionIndex(){
        header("Access-Control-Allow-Origin: *",false);
        $model = \common\models\Product::find()->all();
        return Json::encode($model); 
    }
    public function actionLogins(){
        
      header("Access-Control-Allow-Origin: *",false);
       //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       // \Yii::$app->controller->enableCsrfValidation = false;
       $username = \Yii::$app->request->get("username","");
       $password = \Yii::$app->request->get("password","");
       
       $login = [
           "username"=>$username,
           "password"=>$password
       ];
       return Json::encode($login); 
    }
}
