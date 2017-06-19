<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'header'=>'ลำดับที่',
        'class' => 'kartik\grid\SerialColumn',
        'width' => '100px',
    ],
    [
        'label'=>"รายการสินค้า",
        'format'=>'raw',
        'value'=>function($model){
            $image= \Yii::getAlias('@storageUrl')."/web/img/".$model->product_image;
            return \yii\helpers\Html::img($image, ['class'=>'img img-responsive','style'=>'width:120px;']);
        }
    ],    
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'product_id',
//    ],
     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'product_name',
    ],
////    [
////        'class'=>'\kartik\grid\DataColumn',
////        'attribute'=>'product_detail',
////    ],
     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'product_cost',
        'width' => '100px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'product_price',
        'format'=>'decimal',
        'width' => '100px',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'product_price_pro',
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'product_image',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'product_num_all',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'product_num',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'product_unit',
     ],       
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'create_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'create_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'update_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tbl_productcol',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'product_type_id',
    // ],
   
    [
        'class' => 'kartik\grid\ActionColumn',
        'width' => '150px',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
                    
         'viewOptions'=>['label'=>'<i class="glyphicon glyphicon-eye-open"></i> View','class'=>'btn btn-success btn-sm','role'=>'modal-remote','title'=>'Views','data-toggle'=>'tooltip'],
        'updateOptions'=>['label'=>'<i class="glyphicon glyphicon-edit"></i> Edit','class'=>'btn btn-warning btn-sm','role'=>'modal-remote','title'=>'Edit', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['label'=>'<i class="glyphicon glyphicon-trash"></i> Delete','class'=>'btn btn-danger btn-sm','role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];   