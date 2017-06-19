<?php
namespace appxq\calendar\assets;

use yii\web\AssetBundle;

class MigrateAsset extends AssetBundle
{
    public $sourcePath='@lib/calendar/assets';

    public $css=[
    ];

    public $js=[
	'js/jquery-migrate-1.0.0.js',
    ];
    
    public $depends=[
	'yii\web\YiiAsset',
    ];
}
