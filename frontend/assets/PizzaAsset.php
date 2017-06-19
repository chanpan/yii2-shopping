<?php
 
namespace frontend\assets;

class PizzaAsset extends \yii\web\AssetBundle{
    public $sourcePath = '@themes/pizza';
    public $css = [
        'css/reset.css',
        'css/flexslider.css',
        'css/style.css?1769292',
        'css/jquery-ui.min.css',
        'css/jquery-ui.theme.min.css',
        'css/selectize.default.css',
        'fonts/material-icons.css',
        'css/jquery.smartbanner.css',
        'css/addon.css?1769292',
        'css/stylesheet.css?1769292',
        'fonts/thaifont.css?1769292'
    ];
    public $js = [
        
        'js/jquery-ui.min.js',
        'js/selectize.min.js',
        'js/jquery.validate.min.js',
        'js/jquery.validate.unobtrusive.min.js',
        'js/jquery.flexslider-min.js',
        'js/jquery.ddslick.min.js',
        'js/jquery.smartbanner.js',
        'js/main.js?1769292',
        //'js/livechat.js?1769292'

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
