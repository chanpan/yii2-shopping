<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */
?>
<div class="news-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'message:ntext',
        ],
    ]) ?>

</div>
