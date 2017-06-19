<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:20 AM
 */

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;

class SignInController extends Controller
{

    public $defaultAction = 'login';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

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


    public function actionLogin()
    {
        $this->layout = 'base';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionProfile()
    {
        //print_r($_POST);exit();
        $model = Yii::$app->user->identity->userProfile;
        if ($model->load($_POST)){
            //$tel = $_POST['tel'];
           $model->tel =            $_POST['UserProfile']['tel'];
           $model->address =        $_POST['UserProfile']['address'];
           $model->province =       $_POST['UserProfile']['province'];
           $model->amphur =         $_POST['UserProfile']['amphur'];
           $model->distric =        $_POST['UserProfile']['distric'];
           $model->zipcode =        $_POST['UserProfile']['zipcode'];
           $model->department_id =  $_POST['UserProfile']['department_id'];
           $model->subject_id =     $_POST['UserProfile']['subject_id'];

           
           // print_r($_POST['UserProfile']['tel']);exit();
            //echo $tel;exit();
            if($model->save()){
                Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            return $this->refresh();
            }
            
        }
        return $this->render('profile', ['model'=>$model]);
    }

    public function actionAccount()
    {
        $user = Yii::$app->user->identity;
        $model = new AccountForm();
        $model->username = $user->username;
        $model->email = $user->email;
        if ($model->load($_POST) && $model->validate()) {
            $user->username = $model->username;
            $user->email = $model->email;
            if ($model->password) {
                $user->setPassword($model->password);
            }
            $user->save();
            Yii::$app->session->setFlash('alert', [
                'options'=>['class'=>'alert-success'],
                'body'=>Yii::t('backend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('account', ['model'=>$model]);
    }
    
    /******************************* ทำหน้าที่แก้ไข โปรไฟล์ *****************************************/
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
                echo 1;
            }else{
                echo 0;
            }
            
        }else{
            return $this->renderAjax("_department",[
                'model'=>$model
            ]);
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
