<?php
use common\grid\EnumColumn;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->getPublicIdentity();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<h3>ข้อมูลผู้ใช้</h3><hr>
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
             
            'username',
            [
              'attribute'=>'profile.firstname',  
              'label'=>'ชื่อ-นามสกุล',
               'value'=>function($model){
                    return $model->profile->firstname.' '.$model->profile->lastname;
               } 
            ],
           [
             'label'=>'เพศ',
             'value'=>function($model){
                 $msg="ชาย";
                 if($model->profile->gender == 2){
                     $msg="หญิง";
                 }
                 return $msg;
              }  
           ],         
            [
              'label'=>'ชื่อเล่น',
              'value'=>function($model){
                $nickname = "ไม่มีข้อมูล";
                  if($model->profile->middlename){
                     $nickname = $model->profile->middlename; 
                  }
                return $nickname;
              }
            ],       
                    
            'email:email',
            'created_at:date',
            
        ],
    ]) ?>

</div><hr>
<h3>ข้อมูลการศึกษา</h3>
<div>
<?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [ 
              'label'=>'รหัสนักศึกษา',
               'value'=>function($model){
                    
                    return  $model->profile->student_id;
               } 
            ],
           [
             'label'=>'ที่อยู่',
             'value'=>function($model){
                 //yii\helpers\VarDumper::dump($model->profile->provinces->PROVINCE_NAME, 10, true);exit();
                  $address = $model->profile->address." ตำบล ".$model->profile->districs->DISTRICT_NAME
                          .' อำเภอ '.$model->profile->amphurs->AMPHUR_NAME
                          .' จังหวัด '.$model->profile->provinces->PROVINCE_NAME
                          .' รหัสไปรษณีย์ '.$model->profile->zipcode;
                return  $address;
              }  
           ],         
           
           [
             'label'=>'เบอร์โทรศัพท์',
             'value'=>function($model){
                return  $model->profile->tel;
              }  
           ],        
             
            
        ],
    ]) ?>
</div>
