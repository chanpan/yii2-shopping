<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
$this->title = Yii::t('frontend', 'ลูกค้าที่สมัครสมาชิกไว้แล้ว ');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="container">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h2><?php echo Html::encode('ลูกค้าที่สมัครสมาชิกไว้แล้ว') ?></h2><hr>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?php echo $form->field($model, 'identity')->label("Username") ?>
        <?php echo $form->field($model, 'password')->passwordInput() ?>
        <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
        <div style="color:#999;margin:1em 0">
            <?php
            echo Yii::t('frontend', '  <a href="{link}">ลืมรหัสผ่าน?</a>', [
                'link' => yii\helpers\Url::to(['sign-in/request-password-reset'])
            ])
            ?>
        </div>
        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('frontend', 'ลงชื่อเข้าใช้ '), ['class' => 'btn btn-primary btn-block', 'style'=>'background:#f37021;', 'name' => 'login-button']) ?>
        </div>
        <div class="form-group">
            <?php echo Html::a(Yii::t('frontend', 'ลูกค้าใหม่ใช่หรือไม่? สมัครเลย'), ['signup']) ?>
        </div>
         
<?php ActiveForm::end(); ?>
     
    </div>
    
    <div class="col-md-6">
        
    </div>
</div>
