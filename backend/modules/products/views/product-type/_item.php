 <?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
 ?>

 <a href="<?= Url::to(['update','id'=>$model->product_type_id])?>">
    <div class="">
        
      <div>
          <h5 class="" style=""><?php echo $model->product_type_name?></h5><hr>
      </div>
    </div>
 </a>