<?php
namespace frontend\modules\products\controllers;
use frontend\modules\products\classest\Cart;
use Yii;
use yii\web\Controller;
 
class PromotionController extends Controller
{
     
    public function actionIndex()
    {
        return $this->render("index");
    }
    
    
}
    