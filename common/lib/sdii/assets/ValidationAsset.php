<?php
namespace common\lib\sdii\assets;

use yii\web\AssetBundle;

class ValidationAsset extends AssetBundle
{
    public $sourcePath='@lib/sdii/assets';

    public $css=[
    ];

    public $js=[
	'validation.js',
    ];
    
    public $depends=[
    ];
}
