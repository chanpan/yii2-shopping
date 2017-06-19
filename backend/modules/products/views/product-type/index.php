<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax; 
$this->title = Yii::t('backend', 'Product Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', '<i class="fa fa-plus"></i>', [
    'modelClass' => 'เพิ่มประเภทสินค้า',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]) ?>
    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-sm-4 col-md-4'],
        'itemView' => '_item',
        'pager' => [
            'firstPageLabel' => 'ก่อนหน้า',
            'lastPageLabel' => 'ถัดไป',
            'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        ],
        'layout'=>'{summary}{items}{pager}'//{sorter}
    ]) ?>
<?php Pjax::end() ?>
</div>
<?php 
    $this->registerCss("
        .col-sm-4, .col-md-4{
                padding: 2px;    margin-bottom: -15px;
        }
    ");
?>