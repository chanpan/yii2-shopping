<?php
namespace common\lib\sdii\assets;

use yii\web\AssetBundle;

class SDAsset extends AssetBundle
{
    public $sourcePath='@lib/sdii/assets';

    public $css=[
    ];

    public $js=[
    ];
    
    public $depends=[
	'common\lib\sdii\assets\bootbox\BootBoxAsset',
	'common\lib\sdii\assets\notify\NotifyAsset',
    ];
}
