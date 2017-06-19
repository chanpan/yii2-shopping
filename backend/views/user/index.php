<?php

use common\grid\EnumColumn;
use common\models\User;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\ActiveForm; 
use yii\widgets\Pjax;

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="pull-right">
    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
        'modelClass' => 'User',
         ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    </div>
    <div class="clearfix"></div>
    <p>    
<?php Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]) ?>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover'
        ],
        'columns' => [
           
            [
                'attribute' => 'username',
                'format' => 'raw',
                'headerOptions' => ['style'=>'text-align:center'],
                'value' => function ($model) {
                    return Html::a($model->username, ['update', 'id' =>$model->id], ['class' =>'alink']);
                },
            ],
            'email:email',
            
            [
              'attribute'=>'profile.firstname',  
              'label'=>'ชื่อ-นามสกุล',
               'value'=>function($model){
                    return $model->profile->firstname.' '.$model->profile->lastname;
               } 
            ],       
            [
              'label'=>'ชื่อเล่น',
              'value'=>'profile.middlename'
            ],        
                  
            'created_at:datetime',
            //'logged_at:datetime',
            // 'updated_at',
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],        

            ['class' => 'backend\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<?php Pjax::end() ?>