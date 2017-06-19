<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>
<div class="product-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'product_name',
            'product_detail:ntext',
            'product_cost',
            'product_price',
            'product_price_pro',
            'product_image:ntext',
            'product_num_all',
            'product_num',
            'create_by',
            'create_at',
            'update_by',
            'tbl_productcol',
            'product_type_id',
            'product_unit',
        ],
    ]) ?>

</div>
