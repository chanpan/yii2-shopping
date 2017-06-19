<?php
$form = \yii\bootstrap\ActiveForm::begin([
            'action' => ['index'],
            'class'=>'form-inline',
            'method' => 'get',
            'options' => ['data-pjax' => true]
        ]);
?>
<div class="clearfix"></div>
<div class="input-group">
        <?= \yii\helpers\Html::activeTextInput($model, 'q', ['class' => 'form-control', 'placeholder' => 'ค้นหาข้อมูล...']) ?>
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
     </span>
</div>

<?php \yii\bootstrap\ActiveForm::end(); ?>
<div class="clearfix"></div><br>