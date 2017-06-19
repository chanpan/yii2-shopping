<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ListView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<?php \yii\widgets\Pjax::begin(['id'=>'crud-datatable-pjax']);?>
<?php
 
echo "<div class='col-md-12'>";
echo ListView::widget([
    'id'=>'crud-datatable',
    'dataProvider' => $dataProvider,
    'itemOptions' => [
        'class' => 'col-md-2',
        'style' => 'border: 3px solid #ecf0f5;  padding: 17px 13px 13px 13px;margin:3px;height:350px;'
    ],
    'itemView' => '_items',
    'pager' => [
        'firstPageLabel' => 'ก่อนหน้า',
        'lastPageLabel' => 'ถัดไป',
        'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
        'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
    ],
    'layout' => '{summary}{items}{pager}'//{sorter}
]);
echo "</div>";

$this->registerCss("
    @media (min-width: 992px){
    .col-md-12 {
            width: 117%;
        }
    }   
    #list-header{
        width: 100%;
        font-size: 14pt;
        height: 50px;
        overflow: hidden;
    }
    #list-body{
        width: 100%;
        font-size: 10pt;
        height: 80px;
        overflow: hidden;
        text-align: justify;
        word-wrap: break-word;
        white-space: pre-line;
    }
    
");
?>
<?php

Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
])
?>
<?php Modal::end(); ?>
<?php\yii\widgets\Pjax::end();?>