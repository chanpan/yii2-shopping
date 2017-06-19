<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\ProductTypeSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true,'class' => 'form-inline text-right']
    ]); ?>
    <div class="form-group">
         <?php echo $form->field($model, 'product_type_name') ?>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', '<i class="fa fa-search"></i> ค้นหา'), ['class' => 'btn btn-primary','style'=>'margin-top: -12px;']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
