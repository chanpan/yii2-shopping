<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>

<?php
    
echo GridView::widget([
    'id' => 'crud-datatable',
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'pjax' => true,
    'columns' => require(__DIR__ . '/_columns.php'),
   
   
    'responsive' => true,
    'panel' => [
        'type' => 'default',
        
         
        'after' => BulkButtonWidget::widget([
            'buttons' => Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All', ["bulk-delete"], [
                "class" => "btn btn-danger btn-xs",
                'role' => 'modal-remote-bulk',
                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                'data-request-method' => 'post',
                'data-confirm-title' => 'Are you sure?',
                'data-confirm-message' => 'Are you sure want to delete this item'
            ]),
        ]) .
        '<div class="clearfix"></div>',
    ]
])?>
