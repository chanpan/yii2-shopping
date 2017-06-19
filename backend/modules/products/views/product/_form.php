<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
 
?>

<div class="row">
    
     
    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
                 //'enableClientValidation' => true, 
                 'enableAjaxValidation' => true,
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-3',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-8',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
    ]);
    ?>
   
        <?php  $form->errorSummary($model,['class'=>'alert alert-danger']); ?> 
  
<div class="col-md-12"><?php echo $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?></div>
<div class="col-md-12"> <?php echo $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?></div>    
<div class="clearfix"></div>

<div class="col-md-12">  
<div class="col-md-6 col-sm-offset-3" style="margin-bottom:7px;">
        <a href="#"  id="btnAddProductType"><i class="fa fa-plus"></i> เพิ่มประเภทสินค้า</a>
</div>
    <div class="clearfix"></div>
<?php yii\widgets\Pjax::begin(['id' => 'grid2', 'timeout' => 5000]) ?>  
        <?php echo $form->field($model, 'product_type_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(common\models\ProductType::find()->all(), 'product_type_id', 'product_type_name'),
                'language' => 'th',
                
                'options' => ['prompt' => '-----เลือกประเภทสินค้า-----'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'style'=>'width:50%',
                ],
        ]); ?>
     
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <?php 
        $this->registerJs("
            //
            $('#btnAddProductType').click(function(){
                
                $.ajax({
                    url:'".\yii\helpers\Url::to(['/products/product-type/create2'])."',
                    method:'GET',
                    success:function(data){
                        $('#myModal').modal('show');
                        $('#myModal .modal-title').html('เพิ่มประเภทสินค้า');
                        $('#myModal .modal-body').html(data);
                    }
                })
            });
            
        ");
    ?>
<?php yii\widgets\Pjax::end() ?>    
</div>  
<div class="clearfix"></div>
<div class="col-md-12"> 
    <?php echo $form->field($model, 'product_detail')->textarea(['rows' => 6]) ?>
</div>
<div class="clearfix"></div>
<div class="col-md-12"><?php echo $form->field($model, 'product_cost')->textInput() ?></div>    
<div class="col-md-12"><?php echo $form->field($model, 'product_price')->textInput() ?></div>    
<div class="col-md-12"><?php echo $form->field($model, 'product_price_pro')->textInput() ?></div>
<div class="col-md-12"><?php echo $form->field($model, 'product_unit',[
    'inputOptions'=>[
        'placeholder'=>'ตัวอย่างเช่น ชิ้น,ตัว'
    ]
])->textInput() ?></div>
<div class="clearfix"></div>    
<div class="col-md-12">
    <?php 
    $imagePath = Yii::$app->request->baseUrl."/../frontend/web/img/";
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
        ]); ?>
        
</div>  
<div class="clearfix"></div>    
<div class="col-md-12"><?php echo $form->field($model, 'product_num_all')->textInput() ?></div>    
<div class="col-md-12"> <?php echo $form->field($model, 'product_num')->textInput() ?></div>
<div class="clearfix"></div>
 
        
        <div class="modal-footer">
         <div class="col-md-12">
            <?php echo  Html::submitButton($model->isNewRecord ? Yii::t('backend', 'บันทึก') : Yii::t('backend', 'แก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-success  btn-lg' : 'btn btn-primary  btn-lg']) ?>
            
            <?php 
            if (!$model->isNewRecord) {
                echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->product_id],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'style'=>'    margin-top: -6px;',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete?',
                            'method' => 'post',
                        ]
                    ]);
            }
            ?>
        </div>
        </div>
    <?php
    
      $this->registerJs("
          $('#{$model->formName()}').on('beforeSubmit', function(e) {
            var form = $(this);
            var formData = form.serialize();
            
            $.ajax({
                url: form.attr('action'),
                method:'POST',
                data: formData,
                //dataType:'JSON',
                success: function (data) {
                    console.log(data);
                    alert(data);
                },
                error: function (err) {
                    alert(err);
                }
            });
        }).on('submit', function(e){
            e.preventDefault();
        });
        
        ");
 ?>    
 
    <?php ActiveForm::end(); ?>


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
</div>