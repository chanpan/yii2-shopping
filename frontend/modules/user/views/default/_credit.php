<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
$image = \Yii::getAlias('@storageUrl') . "/web/img/";
$bag = \common\models\Bags::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();
$credit = \common\models\Credits::find()->where(['user_id'=>\Yii::$app->user->identity->id])->one();
$credits="ยังไม่มีเครดิตร";
if(!empty($credit)){
    if($credit->credit_status == 0){
        $credits = "ดี";
    }else{
        $credit = "ไม่ดี";
    }
}
?>
<ul class="nav nav-tabs">
    <li id="menu-bag"><a href="#" id="btn-bag"> กระเป๋าเงิน</a></li>
    <li id="menu-credit"><a href="#" id="btn-credit">เครดิตร</a></li>
</ul> 

<div class="col-md-12">
    <div style="padding:20px 0 0 0" id="bag">
    <span class="text-center" style="     position: relative;
    top: 0px;
    font-size: 19pt;
    font-weight: bold;
    color: green;
    background: #e9ffff;
    display: block;
    padding: 40px;">
        <img src="<?= $image.'point2.png'?>" class="img img-responsive" style="    width: 30px;
    /* float: left; */
    left: 13px;
    padding-left: 2px;
    margin-top: -3px;
    position: absolute;">
        <?= $bag->bag_count?> ฿</span>
        
    </div>
    
    <div id="credit" style="padding:20px 0 0 0; display:none;">
        <div style="    font-size: 20pt;"><?= $credits?></div>
    </div>
  <hr>  
</div>
<?php $this->registerJs("
    $('#btn-bag').click(function(){
        $('#menu-bag').addClass('active');
        $('#menu-credit').removeClass('active');
        $('#bag').show();
        $('#credit').hide();
        return false;
    });
    $('#btn-credit').click(function(){
        $('#menu-credit').addClass('active');
        $('#menu-bag').removeClass('active');
        $('#credit').show();
        $('#bag').hide();
        return false;
    });
")?>
 
