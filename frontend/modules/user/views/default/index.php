<?php

use trntv\filekit\widget\Upload;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
  
use common\models\UserProfile;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\widgets\MaskedInput;//
$this->title = Yii::t('frontend', 'User Settings ')
?>
 <?php $form = ActiveForm::begin(); ?>



<div class="container" id="container">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3">
        <?php
        echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::classname(), [
            'url' => ['avatar-upload']
        ])
        ?>
        <?php
        echo $this->render("_credit");
        ?>   
    </div>    
    <div class="col-lg-9">
        <h4>ข้อมูลส่วนตัว</h4>
        <hr>
        
        <div class="col-md-6">
            <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'gender')->dropDownlist([
                UserProfile::GENDER_MALE => Yii::t('backend', 'ชาย'),
                UserProfile::GENDER_FEMALE => Yii::t('backend', 'หญิง')
            ])
            ?>
        </div>
        <div class="clearfix"></div>
        <h4>ข้อมูลการติดต่อ</h4>
        <hr>
        <div class="col-md-6">    
            <?=
            $form->field($model, 'tel')->widget(MaskedInput::className(), [
                'mask' => '999-999-9999',
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-3">

            <?=
            $form->field($model, 'province')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(common\models\Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
                'language' => 'th',
                'options' => ['prompt' => '-----เลือกจังหวัด-----'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'amphur')->widget(DepDrop::className(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [\common\models\Amphur::find()->where(['AMPHUR_ID' => $model->amphur])->one()->AMPHUR_NAME],
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'province')],
                    'initialize' => false,
                    'initDepends' => [Html::getInputId($model, 'province')],
                    'placeholder' => 'เลือกอำเภอ',
                    'url' => Url::to(['get-amphur'])
                ]
            ])
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'distric')->widget(DepDrop::className(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [\common\models\District::find()->where(['DISTRICT_ID' => $model->distric])->one()->DISTRICT_NAME],
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'amphur')],
                    'initialize' => false,
                    'initDepends' => [Html::getInputId($model, 'amphur')],
                    'placeholder' => 'เลือกตำบล',
                    'url' => Url::to(['get-distric'])
                ]
            ])
            ?>
        </div>
        <div class="col-md-3">
            <?=
            $form->field($model, 'zipcode')->widget(DepDrop::className(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [\common\models\Zipcode::find()->where(['ZIPCODE_ID' => $model->zipcode])->one()->ZIPCODE],
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'amphur'), Html::getInputId($model, 'distric')],
                    'placeholder' => 'กรุณาเลือก',
                    'url' => Url::to(['get-zipcode'])
                ]
            ])
            ?>

        </div>


        <?php yii\widgets\Pjax::begin(['id' => 'grid', 'timeout' => 5000]) ?>   

        <div class="clearfix"></div>
        <h4>ข้อมูลการศึกษา</h4>
        <hr>
        <div class="col-md-12">
            <?php echo $form->field($model, 'student_id')->textInput() ?>    
        </div>
        <div class="col-md-6">
            <a  title="เพิ่มคณะ" class="btn btn-sm btn-info "><i class="fa fa-plus-circle" id="department"></i></a>
            <?php
            echo $form->field($model, 'department_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Department::find()->all(), 'department_id', 'department_name'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกคณะ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <a  title="เพิ่มสาขาวิชา" class="btn btn-sm btn-info" id="subject"><i class="fa fa-plus-circle"></i></a>
            <?php
            echo $form->field($model, 'subject_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Subject::find()->all(), 'subject_id', 'subject_name'),
                'language' => 'th',
                'options' => ['placeholder' => 'เลือกสาขาวิชา'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?> 
        </div>

      <?=   common\lib\sdii\widgets\SDModalForm::widget([
            'id' => 'modal-profile',
            'size' => 'modal-lg',
            //'tabindexEnable' => false,
            'clientOptions'=>['backdrop'=>'static'],
            // 'options'=>['style'=>'overflow-y:scroll;']
        ]);  

    ?>
  
        <?php
            $this->registerJs("
                $('#department').click(function(){
                    var urls = '" . Url::to(['create-department']) . "';
                    showModal(urls,'เพิ่มคณะ');      
                   //return false;
                });
                $('#subject').click(function(){
                    var urls = '" . Url::to(['create-subject']) . "';
                    showModal(urls,'เพิ่มสาขา');      
                    //return false;
                });

                showModal = function(url,title){
                    $.ajax({
                        url:url,
                        success:function(data){
                            //console.log(data);
                            $('#modal-profile').modal('show');
                            $('#modal-profile .modal-title').html(title);
                            $('#modal-profile .modal-content').html(data);
                        }
                    });
                    //return false;
                }
                
            ");
            ?>
    <?php yii\widgets\Pjax::end() ?>    

    </div>
    <div class="row">
        <div class="pull-right" style="margin-right:10px;">
            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>    
    </div>    

    <?php ActiveForm::end(); ?>

</div>




