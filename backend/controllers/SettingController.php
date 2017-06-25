<?php

namespace backend\controllers;

use common\helpers\ArticleHelper;
use Yii;
use common\models\Article;
use backend\models\search\ArticleSearch;
use \common\models\ArticleCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
 use eleiva\noty\Noty;
class SettingController extends Controller
{
 

 
    public function actionIndex()
    {
        $model = \common\models\Interest::find()->one(); 
        
        if(!empty($_POST)){
            $price = $_POST["price"];
            $sql="UPDATE interest SET price=:price,create_by=:create_by,create_at=:create_at WHERE id=:id";
            $query=\Yii::$app->db->createCommand($sql,[
                ':price'=>$price,
                ':create_by'=>Yii::$app->user->identity->id,
                ':create_at'=>Date('y-m-d'),
                ':id'=>1
            ])->execute();
            \Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                
           $model = \common\models\Interest::find()->one(); 
           
                echo Noty::widget([
                     'text' => 'Hi! Looks good!',
                     'type' => Noty::INFORMATION,
                     'useAnimateCss' => true,
                     'clientOptions' => [
                         'timeout' => 5000,
                         'layout' => 'top',
                         'dismissQueue' => true,
                         'theme' => 'relax',
                         'animation' => [
                             'open' => 'animated bounceInLeft',
                             'close' => 'animated bounceOutLeft',
                             'easing' => 'swing',
                             'speed' => 500
                         ]
                     ]
                 ]);
           $result = [
                    'status' => 'success',
                    'action' => 'create',
                    'message' => '<strong><i class="glyphicon glyphicon-remove-sign"></i> Success!</strong> ' . Yii::t('app', ''),
                    'price'=>$model->price
                ];
           return $result;
        }
        return $this->render('index', ['model'=>$model]);
    }

   
}
