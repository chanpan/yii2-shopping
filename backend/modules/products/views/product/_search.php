<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\ProductSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'product_id') ?>

    <?php echo $form->field($model, 'product_name') ?>

    <?php echo $form->field($model, 'product_detail') ?>

    <?php echo $form->field($model, 'product_cost') ?>

    <?php echo $form->field($model, 'product_price') ?>

    <?php // echo $form->field($model, 'product_price_pro') ?>

    <?php // echo $form->field($model, 'product_image') ?>

    <?php // echo $form->field($model, 'product_num_all') ?>

    <?php // echo $form->field($model, 'product_num') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'tbl_productcol') ?>

    <?php // echo $form->field($model, 'product_type_id') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
