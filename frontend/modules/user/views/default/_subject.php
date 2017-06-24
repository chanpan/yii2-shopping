<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>

<?php
$form = ActiveForm::begin([
            'id' => $model->formName(),
            'enableAjaxValidation'=>true
        ]);
?>

<div class="modal-header">
    <button type="button" class="close" id="btn-modal-close">&times;</button>
    <h4 class="modal-title" style="font-size: 14pt;"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-content">
    <div class="form-group">
<?= $form->field($model, 'subject_name')->textInput() ?>
    </div>
    <div class="form-group">
<?php echo Html::submitButton(Yii::t('backend', 'เพิ่ม'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php  $this->registerJs("
$('form#{$model->formName()}').on('beforeSubmit', function(e) {
    var \$form = $(this);
    $.post(
	\$form.attr('action'), //serialize Yii2 form
	\$form.serialize()
    ).done(function(result) {
	console.log(result);
        
        $.pjax.reload({container:'#grid'}); //refresh the grid
        $('#modal-profile').modal('hide');
    }).fail(function() {
	console.log('server error');
    });
    return false;
});
$('#btn-modal-close').click(function(){
        $.pjax.reload({container:'#grid'}); //refresh the grid
        $('#modal-profile').modal('hide');
    });
");
?>




















