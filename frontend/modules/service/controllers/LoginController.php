<?php
namespace frontend\modules\service\controllers;
use Yii;
use yii\web\Controller;
use yii\helpers\Json;
use common\models\User; 
class LoginController extends \yii\rest\ActiveController{
    public $modelClass = 'common\models\User';
    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }
    public function actionCreate(){
        $model = new \frontend\modules\user\models\SignupForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(),'')) {
            if($user = $model->signup()){
                if(!\Yii::$app->getUser()->login($user)){
                    throw new \yii\base\ErrorException();
                }
            }
            
        }
        return $model;
    }
    
        
}
