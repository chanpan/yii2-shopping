<?php 
    use yii\grid\GridView;
?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ],
        'columns' => [
            'product_name',
            'product_cost',
            'product_price',
            'product_unit',
            ['class' => 'backend\grid\ActionColumn'],
        ],
    ]); 
?>
