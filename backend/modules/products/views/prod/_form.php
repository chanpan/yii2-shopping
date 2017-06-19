<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
    <?php
    echo $form->field($model, 'product_type_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\ProductType::find()->all(), 'product_type_id', 'product_type_name'),
        'language' => 'th',
        'options' => ['prompt' => '-----เลือกประเภทสินค้า-----'],
        'pluginOptions' => [
            'allowClear' => true,
            'style' => 'width:50%',
        ],
    ]);
    ?>

    <?= $form->field($model, 'product_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_cost')->textInput() ?>

    <?= $form->field($model, 'product_price')->textInput() ?>

    <?= $form->field($model, 'product_price_pro')->textInput() ?>

    <?php
    $imagePath = Yii::$app->request->baseUrl . "/../frontend/web/img/";
    $initialPreview = ($model->product_image != '') ? Html::img($imagePath . $model->product_image, ['class' => 'file-preview-image']) : '';
    echo $form->field($model, 'product_image')->widget(kartik\widgets\FileInput::classname(), [
        'pluginOptions' => [
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false,
            //'previewFileType' => 'image',
            // 'initialPreview' => $initialPreview,
            //'overwriteInitial' => true,
            //'showRemove' => false,
            // 'showUpload' => false,
            'allowedFileExtensions' => ['png', 'jpg', 'jpeg'],
            'maxFileSize' => 5000,
        ],
        'options' => ['multiple' => false]//,'accept' => 'image/*'
    ]);
    ?>

    <?= $form->field($model, 'product_num_all')->textInput() ?>

    <?= $form->field($model, 'product_num')->textInput() ?>

   
    <?= $form->field($model, 'product_unit')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
 <?php
    
    $this->registerCss("
        .btn{
            margin-bottom:5px;
        }
        div.required label.control-label:after {
            content: \" *\";
            color: red;
        }
    ");
 
 ?>