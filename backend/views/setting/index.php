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
<?= $this->registerJSFile(yii\helpers\Url::to('@web/web/noty/noty.min.js'))?>
<?= $this->registerJSFile(yii\helpers\Url::to('@web/web/noty/notylib.js'))?>
<?= $this->registerJS("
    $('#btnSave').click(function(){
        $.ajax({
            url:'".yii\helpers\Url::to(['index'])."',
            type:'POST',
            data:{price:$('#price').val()},
            dataType:'JSON',
            success:function(data){
                console.log(data.price);
                
               noty(type='success', layout='bottomRight', message=''+data.message);
                $('#price').html(data.price);
            }
        });
});
")?>