<?php
namespace frontend\modules\products\classest;
use common\models\Product;
class Cart {
    function addCart($id){
        $data = new Product();
        $dataProduct=$data->getInfoProductBy($id);
        if(!Yii::$app->session['cart']){
            $cart[$id]=[
                "product_name"=>$dataProduct["product_name"],
                "product_price"=>$dataProduct["product_price_pro"],
                "pro_sl"=>1
            ];
        }else{
            $cart = Yii::$app->session['cart'];
            if(array_key_exists($id, $cart)){
                $cart[$id]=[
                    "product_name"=>$dataProduct["product_name"],
                    "product_price"=>$dataProduct["product_price_pro"],
                    "pro_sl"=>1
                ];
            }
        }
        \Yii::$app->session['cart']=$cart;
    }
}
