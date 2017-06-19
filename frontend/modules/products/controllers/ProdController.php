<?php

namespace frontend\modules\products\controllers;

use yii\web\Controller;
 
class ProdController extends Controller
{
     
    public function actionIndex()
    {
        $sort = \Yii::$app->request->get('sorter','1'); 
        if($sort == 1){
            $sort = "ASC";
        }else if($sort == 2){
            $sort = "DESC";
        }else{
            $sort = "ASC";
        } 
        
        $start = \Yii::$app->request->get("start",0);
        $end = \Yii::$app->request->get("start",5);
        
        $sql="SELECT * FROM tbl_product ORDER BY product_name $sort LIMIT :start,:end ";
        $query = \Yii::$app->db->createCommand($sql,[
            ":start"=>(int)$start,
            ":end"=>(int)$end
        ])->queryAll();
        $query = \common\lib\nut\Lib::ArrayToObject($query);
        
        $product_type = \common\models\ProductType::find()->all();
        return $this->render('index', [
            'model'=>$query,
            'product_type'=>$product_type
        ]);
    }
    
}
