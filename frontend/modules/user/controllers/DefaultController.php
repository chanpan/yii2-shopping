<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $accountForm = new AccountForm();
        $accountForm->setUser(Yii::$app->user->identity);
        $model = \common\models\UserProfile::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();
        $models = new MultiModel([
            'models' => [
                'account' => $accountForm,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           //$locale = $model->getModel('profile')->locale;
            //Yii::$app->session->setFlash('forceUpdateLocale');
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-success'],
                'body' => Yii::t('frontend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('index', ['model'=>$model]);
    }
    //public $enableCsrfValidation = false;
    public function actionGetAmphur() {
          if(!empty($_POST['depdrop_all_params'])){
             $provinec_id = $_POST['depdrop_parents']['0'];
            echo \common\lib\Province::getAmphur($provinec_id); 
          } 
    }
     public function actionGetDistric() {
          if(!empty($_POST['depdrop_all_params'])){
             $amphur_id = $_POST['depdrop_parents']['0'];
            echo \common\lib\Province::getDistric($amphur_id); 
          } 
    }
    public function actionGetZipcode() {
          if(!empty($_POST['depdrop_all_params'])){
             $amphur_id = $_POST['depdrop_parents']['0'];
             $distric_id = $_POST['depdrop_parents']['1'];
              echo \common\lib\Province::getZipcode($amphur_id, $distric_id);
          } 
    }
     /******************************* ทำหน้าที่สร้าง คณะ กับ สาขา *****************************************/
   // public $enableCsrfValidation = false;
    public function actionCreateDepartment(){
        $model = new \common\models\Department();
         
        if($model->load(Yii::$app->request->post())){
            //print_r($_POST);exit();
            $model->department_name = $_POST['Department']['department_name'];
            if($model->save()){
                return 1;
            }else{
               return 0;
            }
            
        }else{
            return $this->renderAjax("_department",[
                'model'=>$model
            ]);
        }
        
    }
    public function actionAjaxValidation(){
        $model = new \common\models\Department();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format="json";
            return \yii\bootstrap\ActiveForm::validate($model);
        }
    }
    
    public function actionCreateSubject(){
        $model = new \common\models\Subject();
         
       
        if($model->load(Yii::$app->request->post())){
            //print_r($_POST);exit();
            $model->subject_name = $_POST['Subject']['subject_name'];
            if($model->save()){
                echo 1;
                
            }else{
                echo 0;
            }
            
        }else{
            return $this->renderAjax("_subject",[
                'model'=>$model
            ]);
        }
        
    }
}
