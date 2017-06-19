 <?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
 ?>

 <a href="<?= Url::to(['update','id'=>$model->product_type_id])?>">
    <div class="thumbnail">
        
      <div class="caption">
          <h3 class="text-center"><?php echo $model->product_type_name?></h3>
      </div>
    </div>
 </a>