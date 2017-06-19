<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductType */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Product Type',
]) . ' ' . $model->product_type_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_type_id, 'url' => ['view', 'id' => $model->product_type_id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="product-type-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
