<?php

namespace backend\modules\products\controllers;

use Yii;
use common\models\Product;
use backend\modules\products\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
//use backend\modules\products\models\ProdSearch;

use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
         
        return $this->renderAjax('index');
    }

    /**
     * Displays a single Product model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Product();  
        $file_old = $model->product_image;//เก็บชื่อไฟล์ 
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "เพิ่มสินค้าใหม่",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $model->product_image = \yii\web\UploadedFile::getInstance($model, 'product_image');
                if ($model->product_image !== null) {//ถ้ามีไฟล์
                    $nameArr = explode('/', $model->product_image->type); //ตัดเอา ชนิด jpeg ผ่าน /
                    $lname = $nameArr[1]; //เอา array ที่ 1 จะมี 0 , 1

                    if ($file_old != '') { //ถ้าไฟล์ไม่เท่ากับค่าว่าง
                        //ถ้ามีไฟล์เดิม ลบออก
                        unlink(\Yii::getAlias('@storage') . '/web/img/' . $file_old);
                        //unlink(\Yii::getAlias('@storageUrl'). '/web/img' . $file_old);
                    }
                    //Yii::$app->request->baseUrl."/../frontend/web/img/"

                    $newFileName = 'product_' . \common\lib\codeerror\helpers\GenMillisecTime::getMillisecTime() . '.' . $lname;
                    $fullPath = \Yii::getAlias('@storage') . '/web/img/' . $newFileName;
                    $model->product_image->saveAs($fullPath);
                    $model->product_image = $newFileName;
                    
                }
                $model->create_by = \Yii::$app->user->identity->id;
                if( $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "เพิ่มสินค้าใหม่",
                    'content'=>'<span class="alert alert-success" style="display:block;">เพิ่มสินค้าเรียบร้อย</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('เพิ่มสินค้า',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
                }
            }else{           
                return [
                    'title'=> "Create new Product",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->product_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }
//    public function actionCreate()
//    {
//        $model = new Product();
//        $file_old = $model->product_image;//เก็บชื่อไฟล์ 
//        
//   
//        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
//            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            return \yii\bootstrap\ActiveForm::validate($model);
//        }
//        //Ajax Validation End
//        if ($model->load(Yii::$app->request->post())) {
//             
//                $model->product_image = \yii\web\UploadedFile::getInstance($model, 'product_image'); 
//                 if ($model->product_image !== null) {//ถ้ามีไฟล์
//
//                      $nameArr = explode('/', $model->product_image->type);//ตัดเอา ชนิด jpeg ผ่าน /
//                      $lname = $nameArr[1]; //เอา array ที่ 1 จะมี 0 , 1
//
//                      if ($file_old != '') { //ถ้าไฟล์ไม่เท่ากับค่าว่าง
//                          //ถ้ามีไฟล์เดิม ลบออก
//                          unlink(\Yii::getAlias('@storage') . '/web/img/' . $file_old);
//                          //unlink(\Yii::getAlias('@storageUrl'). '/web/img' . $file_old);
//                      }  
//                      //Yii::$app->request->baseUrl."/../frontend/web/img/"
//
//                      $newFileName = 'product_' . \common\lib\codeerror\helpers\GenMillisecTime::getMillisecTime() . '.' . $lname;
//                      $fullPath  = \Yii::getAlias('@storage') . '/web/img/'. $newFileName;
//                      $model->product_image->saveAs($fullPath);
//                      $model->product_image = $newFileName;
//                      \yii\helpers\VarDumper::dump($fullPath);exit();
//                      
//                       
//                      
//                 } 
//                 $msg=[];
//                 if($model->save()){
//                          $msg=['message'=>"success","status"=>200];
//                 }else{
//                          $msg=['message'=>"error","status"=>500];
//                 }
//              echo \yii\helpers\Json::encode($msg);
//        }
//   
//             return $this->renderAjax('create', [
//                        'model' => $model,
//            ]);
//        
//        
//    }
    public function actionCustomGrid(){
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->pagination->pageSize=1;
        
        $url="_grid";
        if($_POST['options'] == 1){
            $url="_list";
        }
        //echo $url;exit();
        return $this->renderAjax($url, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if (\Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\bootstrap\ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('update', [
        'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Product item does not exist.');
        }
    }
}
