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
<div class="product-index">
    <div id="ajaxCrudDatatable">
        <?= $this->render("layouts/_search",["status"=>$status])?>
        <?= $this->render("layouts/_add")?>
        <?= $this->render("_search",['model' => $searchModel])?>
        <div class="clearfix"></div>
        
      <?php yii\widgets\Pjax::begin(['id' => 'crud-datatable-pjax','timeout'=>5000]) ?>  
        <?php 
            if($status == "grid"){
                echo $this->render("layouts/grid",[
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else if($status == "list"){
                echo $this->render("layouts/list",[
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        ?>
     <?php yii\widgets\Pjax::end() ?>   
        
    </div>
    <?php
    Modal::begin([
        "id" => "ajaxCrudModal",
        "footer" => "", // always need it for jquery plugin
    ])
    ?>
<?php Modal::end(); ?>
