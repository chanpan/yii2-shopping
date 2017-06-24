<?php
namespace frontend\modules\products\controllers;
use frontend\modules\products\classest\Cart;
use Yii;
use yii\web\Controller;
 
class ProdController extends Controller
{
     
    public function actionIndex()
    {
        $sort = \Yii::$app->request->get('sorter','1'); 
        $showpage=\Yii::$app->request->get('showpage','20'); 
        if($sort == 1){
            $sort = SORT_ASC;
        }else if($sort == 2){
            $sort = SORT_DESC;
        }else{
            $sort = SORT_ASC;
        } 
//        
//        $start = \Yii::$app->request->get("start",0);
//        $end = \Yii::$app->request->get("start",5);
//         
//       $sql="SELECT * FROM tbl_product ORDER BY product_name $sort LIMIT :start,:end ";      
//        $query = \Yii::$app->db->createCommand($sql,[
//            ":start"=>(int)$start,
//            ":end"=>(int)$end
//        ])->queryAll();        
//        $query = \common\lib\nut\Lib::ArrayToObject($query);
//        
        $query = \backend\modules\products\models\ProductSearch::find()->orderBy(["product_id"=>$sort]);
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>$showpage]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
    
        
        $product_type = \common\models\ProductType::find()->all();
        return $this->render('index', [
            //'model'=>$query,
            'pages'=>$pages,
            'product_type'=>$product_type,
            'model'=>$models
        ]);
    }
    public function actionDetail(){
        $product_id = \Yii::$app->request->get('product_id','id');
        $model = \backend\modules\products\models\ProductSearch::find()->where(['product_id'=> base64_decode($product_id)])->one();
        return $this->render("detail",[
            'model'=> $model
        ]);
    }
    public function actionCart($id){
        $product_id = \Yii::$app->request->get('id','');
        $model = \common\models\Product::find()->where(['product_id'=> $product_id])->one();
        $cart = \common\models\Carts::find()->where(['product_id'=>$product_id])->one();
       // \yii\helpers\VarDumper::dump($_COOKIE['carts']);exit();
        //echo $product_id;exit();
        return $this->renderAjax("cart",[
            'model'=>$model,
            'cart'=>$cart
        ]);
    }
    public function actionAddCarts(){
        $product_id = Yii::$app->request->post('product_id','');
        $items = Yii::$app->request->post('items','');
        $product = \common\models\Product::find()->where(['product_id'=> base64_decode($product_id)])->one();
        $model = \common\models\Carts::find()->where(['user_id'=> 1])->one();
        
        if(!empty(Yii::$app->request->post())){
            if(!empty($model)){
                $prie = $product->product_price * (int)$items;
                //update cart
                $model->user_id = 1;
                $model->product_item += (int)$items;
                $model->product_price +=  $prie;
                $model->save();
                // \yii\helpers\VarDumper::dump($model->user_id);exit();
            }else{
                //insert 
                $model = new \common\models\Carts();

                $model->user_id = 1;
                $model->product_id = base64_decode($product_id);
                $model->product_item = (int)$items;
                $model->product_price = $product->product_price * (int)$items;
                $model->cookie_date = 7;
                $model->save();
                
            }
            
            $show= \common\models\Carts::find()->where(['user_id'=> 1])->one();
            return \yii\helpers\Json::encode($show);
        }
       
        
        
        
        
    }
    
}
    