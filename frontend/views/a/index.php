<div id="show"></div>
<button id="Send">Send</button>
<input type="text" id="name">
<?php $this->registerJs("
    
    
    $('#Send').click(function(){
        var name = $('#name').val();
        $.ajax({
            url:'".\yii\helpers\Url::to(['a/update'])."',
            method:'POST',
            data:{name:name},
            success:function(res){
              console.log(res);
            }
        });
    });

")?>
