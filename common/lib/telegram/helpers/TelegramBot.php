<?php

namespace common\lib\telegram\helpers;

use Yii;

class TelegramBot
{
    public $token;

    public function sendMessage($chat_id, $text)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.telegram.org/bot".$this->token."/sendMessage",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "chat_id=".$chat_id."&text=".$text."&parse_mode=markdown",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 3bf605c0-40a8-a49b-3e64-48c6cba11a05"
            ),
        ));
        if(Yii::$app->keyStorage->get('telegram.enable')==1) {
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return $err;
            } else {
                return $response;
            }
        }
    }
}
