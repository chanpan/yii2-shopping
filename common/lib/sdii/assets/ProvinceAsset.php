<?php
namespace common\lib\sdii\assets;

use yii\web\AssetBundle;

class ProvinceAsset extends AssetBundle
{
    public $sourcePath='@lib/sdii/assets';

    public $css=[
	
    ];

    public $js=[
		
    ];
    
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
