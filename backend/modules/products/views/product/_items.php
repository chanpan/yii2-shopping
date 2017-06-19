<?php

use yii\helpers\Html;
use yii\helpers\Url;

//$img = \Yii::getAlias('@frontend') . '/web/img/';
//$img = \Yii::$app->request->baseUrl . "/../frontend/web/img/";

 //$image = \Yii::getAlias('@storageUrl')."/web/noimg.jpg";

$image= \Yii::getAlias('@storageUrl')."/web/img/".$model->product_image;
?>
 
<div class="">
    <img src="<?= $image ?>" class="img img-responsive img-polaroid" style="width:100%">
    <div class="caption">
        <h3><?= $model->product_name?></h3>
        <p>...</p>
        <p>
            <a href="#" id="btnUpdate" 
               onclick="Update('<?= Url::to(['update','id'=>$model->product_id])?>')" 
               class="btn btn-primary">แก้ไข</a> 
            <a href="#" class="btn btn-default">Button</a>
        </p>
    </div>
</div>    
