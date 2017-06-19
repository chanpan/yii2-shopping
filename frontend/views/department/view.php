<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Department */
?>
<div class="department-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'department_id',
            'department_name',
        ],
    ]) ?>

</div>
