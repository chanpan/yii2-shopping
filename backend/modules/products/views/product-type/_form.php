<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductType */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="row">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'id' => $model->formName(),
    ]); ?>

    <?php  $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'product_type_name')->textInput(['maxlength' => true]) ?>
 
    <?php if($status == 2): ?>
        <div class="col-md-4">
            <?php 
            echo \yii\helpers\Html::a('<span class="glyphicon glyphicon-arrow-left"></span>'. Yii::t('backend', 'Back'), ['index'],['class'=>'btn btn-default btn-block']);
            ?>
        </div>
    <?php endif; ?>
        <div class="col-md-4">
            <?php echo  Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
        </div>
        <div class="col-md-4">
            <?php 
            if (!$model->isNewRecord) {
                echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->product_type_id],
                    [
                        'class' => 'btn btn-warning btn-block',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete?',
                            'method' => 'post',
                        ]
                    ]);
            }
            ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
 
 <?php
    if($status == 1){
      $this->registerJs("
        $('form#{$model->formName()}').on('beforeSubmit', function(e) {
            var \$form = $(this);
            $.post(
                \$form.attr('action'), //serialize Yii2 form
                \$form.serialize()
            ).done(function(result) {
                console.log(result);

                $.pjax.reload({container:'#grid'}); //refresh the grid
                $('#myModal').modal('hide');
            }).fail(function() {
                console.log('server error');
            });
            return false;
        });
        ");
 
    }
    $this->registerCss("
        .btn{
            margin-bottom:5px;
        }
    ");
 ?>