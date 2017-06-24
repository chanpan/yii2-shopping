<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "ตะกร้าสินค้า";
$img = \Yii::getAlias('@storageUrl') . "/web/img/";
?>

<div class="modal-header">
    <button type="button" class="close" id="btn-modal-close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" style="font-size: 14pt;"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-content">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div style="padding:5px;">
                <h4 style="color: #05da05;font-size: 14pt;"><b>สินค้า <?= $cart->product_item; ?> ชิ้นได้ถูกเพิ่มเข้าไปในตะกร้าสินค้าของคุณ</b></h4>
                <div class="col-md-6 col-sm-6  col-xs-6">
                    <img src="<?= $img . $model->product_image; ?>" class="img img-responsive">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p style="font-size:12pt;"><b><?= $model->product_name; ?></b></p>
                    <p style="font-size:10pt;"><?= $model->product_detail; ?></p>
                    <p style="font-size:14pt;"><?= number_format($model->product_price, 2); ?> บาท</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12" style="border-left: 1px solid whitesmoke;">
            <h4 style="color: #000;font-size: 14pt;"><b>ตะกร้าสินค้าของคุณ (<?= $cart->product_item; ?> สินค้า)</b></h4>
            <h5 style="font-size: 12pt;">มูลค่าสินค้า: <span style="float: right;font-size: 12pt;font-weight: bold;margin-right: 15px;"><?= number_format($cart->product_price, 2); ?> บาท</span></h5>
            <hr>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="#" style="font-size: 12pt;">เลือกสินค้าเพิ่ม</a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <button class="btn btn-warning">ชำระค่าสินค้า</button>
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <hr>
            <h3>สินค้าขายดีติดอันดับ</h3>
        </div>
    </div>
</div>