<?php
    use yii\helpers\Html;
?>

<div class="btn-group pull-right">
    <?=
    Html::a('<i class="fa fa-plus"></i> เพิ่มสินค้าใหม่', ['create'], ['role' => 'modal-remote', 'title' =>
        'เพิ่มสินค้าใหม่', 'class' =>
        'btn btn-lg btn-lg btn-success '
    ]);
    ?>

</div>
