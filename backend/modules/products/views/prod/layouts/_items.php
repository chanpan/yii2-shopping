<?php

use yii\helpers\Html;
use yii\helpers\Url;
$image= \Yii::getAlias('@storageUrl')."/web/img/".$model->product_image;
?>
 
<div class="text-center">
    <img src="<?= $image ?>" class="img img-responsive img-polaroid text-center" style="width:150px; margin:0 auto">
    <div class="caption">
        <div id="list-header"><?= $model->product_name?></div>
        <div id="list-body"><?= $model->product_detail?></div>
        <p>
             <?=
                Html::a('<i class="fa fa-pencil"></i> แก้ไข', ['update','id'=>$model->product_id], ['role' => 'modal-remote', 'title' =>
                    'แก้ไข', 'class' =>
                    'btn btn-warning '
                ]);
            ?>
            <?=
                Html::a('<i class="fa fa-trash"></i> ลบ', ['delete','id'=>$model->product_id], ['role' => 'modal-remote', 'title' =>
                    'แก้ไข', 
                    'class' =>'btn btn-danger',
                    'role'=>'modal-remote',
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Are you sure?',
                    'data-confirm-message'=>'Are you sure want to delete this item'
                ]);
            ?>
              
        </p>
    </div>
</div>
<style>
    .box-body {
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
    }
    
</style>
