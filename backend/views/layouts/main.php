<?php
/**
 * @var $this yii\web\View
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
    <div class="box box box-primary">
        <div class="box-body">
            <?php echo $content ?>
        </div>
        <style>
            .btn-primary {
                background-color: #0275d8;
                border-color: #367fa9;
            }
        </style>
    </div>
<?php $this->endContent(); ?>