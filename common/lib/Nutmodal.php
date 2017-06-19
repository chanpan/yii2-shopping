<?php
 
namespace common\lib;
use yii\bootstrap\Modal;
 use lavrentiev\widgets\toastr\Notification;
class Nutmodal {
    public static function Modal($id="",$title="",$size="",$footer=""){
        Modal::begin([  
            'header'=>'<h3 class="modal-title" style="font-weight: bold;">'.$title.'</h3>',
            'clientOptions' => ['backdrop' => 'static', 'keyboard' => true] ,
            'options'=>[
                'id'=>$id,
                'size'=>$size,
                'class' => 'slide',
                'tabindex' => false
            ],
            //'footer'=>$footer,
            //'tabindex' => false 
             
        ]);
        //echo $content;
        
        Modal::end();
    }
}
