<?php
namespace common\lib\sdii\assets\bootbox;

use yii\web\AssetBundle;

class BootBoxAsset extends AssetBundle
{
    public $sourcePath='@lib/sdii/assets/bootbox';

    public $css=[
    ];

    public $js=[
        'js/bootbox.min.js',
        'js/confirm.js'
    ];
    
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
