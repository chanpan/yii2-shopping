<?php

namespace backend\modules\linebot\controllers;

use yii\web\Controller;

use common\models\LineBot;
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $msg="message=มีสมาชิกใหม่ http://localhost/php/yii2-starter-kit-lite/backend/user/1";
        \common\lib\LineBoth::getLineBoth("I98D9mSpc03jdS4fkr9BOEvRX9mWt1yr9uCwzoRsqYX", $msg);
        return $this->render('index');
    }
    
    public function sendLine($msg)
    {
        $line_token = 'I98D9mSpc03jdS4fkr9BOEvRX9mWt1yr9uCwzoRsqYX';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        if(!empty($image)){
            
        }else{
             $imgs="http://localhost/php/yii2-starter-kit-lite/storage/web/source/1/wnBxMvsg0_1498286016.jpg";
             $url="http://localhost/php/yii2-starter-kit-lite/backend/user/1";
             //$message = "message=".$url.' '."&imageThumbnail=".$imgs.";
             $message = "message=มีสมาชิกใหม่ ".$url;    
             

             curl_setopt($ch, CURLOPT_POSTFIELDS,$message);
        }
        // follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$line_token,
        ]);
        
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch); 
    }
}
