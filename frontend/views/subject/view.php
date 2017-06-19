<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subject */
?>
<div class="subject-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject_id',
            'subject_name',
        ],
    ]) ?>

</div>
