<?php
$img = \Yii::$app->request->baseUrl . "/../frontend/web/img/";
?>
<h1 class="title pull-left">
    สินค้า
    <span>

        <span>
            <a href="<?= \yii\helpers\Url::to(['index', 'status' => 'grid']) ?>">
                <img src="<?= $img . "tablemode.png" ?>" alt="" title="โหมดตารางสินค้า" height="30"></a>
        </span>

        <span>
            <a href="<?= \yii\helpers\Url::to(['index', 'status' => 'list']) ?>">
                <img src="<?= $img . "picturemode.png" ?>" alt="" title="โหมดรูปสินค้า" height="30"></a>
        </span>
    </span>
</h1>


 