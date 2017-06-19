<?php

namespace backend\modules\products\controllers;

use Yii;
use common\models\Product;
use backend\modules\products\models\ProdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ProdController implements the CRUD actions for Product model.
 */
class ProdController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
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
        $status = isset($_GET['status']) ? $_GET['status'] : "grid";
        
        $searchModel = new ProdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status'=>$status
        ]);
    }
    public function actionGrid(){
        $searchModel = new ProdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->renderAjax('layouts/grid', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionList(){
       $searchModel = new ProdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->renderAjax('layouts/list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }

    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Product #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Product model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
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

    /**
     * Updates an existing Product model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
         $file_old = $model->product_image;//เก็บชื่อไฟล์ 
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Product #".$id,
                    'content'=>$this->renderAjax('update', [
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
                $model->update_by = \Yii::$app->user->identity->id;
       
                if($model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Product #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];   
                }
                 
            }else{
                 return [
                    'title'=> "Update Product #".$id,
                    'content'=>$this->renderAjax('update', [
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Product model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Product model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
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
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
