<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'สร้างบัญชีลูกค้าใหม่');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="container">
    <h2><?php echo Html::encode($this->title) ?></h2><hr>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
             <?php if(Yii::$app->session->hasFlash('alert')): ?>
                <div class="alert alert-danger" role="alert">  
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> 
                    <?= Yii::$app->session->getFlash('alert')['body'] ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php echo $form->field($model, 'username') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <?php echo $form->field($model, 'confirmpassword')->passwordInput()->label('ยืนยันหัสผ่านอีกครั้ง') ?>
            
                <div class="form-group">
                    <p class="mbs">* ข้อมูลต้องกรอก</p>
                    <?php echo Html::submitButton(Yii::t('frontend', 'ตกลง'), ['style'=>'background:#f37021;','class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
                </div>
                   
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
