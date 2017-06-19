<?php
namespace common\lib\sdii\assets\drawing;

use yii\web\AssetBundle;

class DrawingAsset extends AssetBundle
{
    public $sourcePath='@lib/sdii/assets/drawing';

    public $css=[
	'css/icon.css',
	'css/style.css'
    ];

    public $js=[
		'js/text.js',
        'js/drawingLive.js',
        'js/excanvas.min.js',
		'js/jquery.event.drag-2.2.js',
		'js/jquery.fullscreen.min.js'
    ];
    
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
