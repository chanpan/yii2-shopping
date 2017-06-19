<?php
 
namespace common\lib;
 use lavrentiev\widgets\toastr\Notification;
class Toast {
    public static function shotToast($type,$title,$msg){
        return Notification::widget([
                'type' => $type,
                'title' => $title,
                'message' => $msg,
                'options' => [
                    "closeButton" => false,
                    "debug" => false,
                    "newestOnTop" => false,
                    "progressBar" => false,
                    "positionClass" => "toast-bottom-right",
                    "preventDuplicates" => false,
                    "onclick" => null,
                    "showDuration" => "300",
                    "hideDuration" => "1000",
                    "timeOut" => "5000",
                    "extendedTimeOut" => "1000",
                    "showEasing" => "swing",
                    "hideEasing" => "linear",
                    "showMethod" => "fadeIn",
                    "hideMethod" => "fadeOut"
                ]
            ]);
    }
}
