<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=>[
        'PUT,POST products/prod/<id:\d+>' => 'post/create',       // Method PUT,POST
        'DELETE products/prod/<id:\d+>' => 'post/delete',         // Method DELETE
        'products/prod/<id:\d+>' => 'products/prod/index',                 // Method GET

        // rules พื้นฐานที่ต้องกำหนด
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ]
];
