<?php

use yii\helpers\Html;
 
$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Product Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'status'=>1
    ]) ?>

</div>
