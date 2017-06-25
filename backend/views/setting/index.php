<?php
$this->title = "อัตราดอกเบี้ย";
 use eleiva\noty\Noty;
?>
<h2><?= \yii\helpers\Html::encode($this->title);?></h2><hr>
<div class="col-md-6">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="" id="price" value="<?= $model->price?>">
      <span class="input-group-btn">
          <button class="btn btn-warning" id="btnSave" type="button">ตกลง</button>
      </span>
    </div><!-- /input-group -->
</div>

<?= $this->registerJS("
    $('#btnSave').click(function(){
        $.ajax({
            url:'".yii\helpers\Url::to(['index'])."',
            type:'POST',
            data:{price:$('#price').val()},
            dataType:'JSON',
            success:function(data){
                console.log(data.price);
                " . 
               
                     Noty::widget([
                         'text' => 'Hi! Looks good!',
                         'type' => Noty::INFORMATION,
                         'useAnimateCss' => true,
                         'clientOptions' => [
                             'timeout' => 5000,
                             'layout' => 'top',
                             'dismissQueue' => true,
                             'theme' => 'relax',
                             'animation' => [
                                 'open' => 'animated bounceInLeft',
                                 'close' => 'animated bounceOutLeft',
                                 'easing' => 'swing',
                                 'speed' => 500
                             ]
                         ]
                     ])
                . ";
                $('#price').html(data.price);
            }
        });
});
")?>