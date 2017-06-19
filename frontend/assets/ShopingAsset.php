<?php

namespace frontend\assets;

class ShopingAsset extends \yii\web\AssetBundle {

    public $sourcePath = '@themes/shoping';
    public $css = [
        //'css/bootstrap.min.css',
        'css/font-awesome/css/font-awesome.min.css',
        'css/font-awesome-animation.css',
        'css/stylesheet.css',
        'css/auto-search.css',
        'css/lightbox.css',
        'css/owl.carousel.css',
        
    ];
    public $js = [
        'js/jquery.elevatezoom.js',
        'js/bootstrap.min.js',
        'js/custom.js',
        'js/lightbox-2.6.min.js',
        
        'js/common.js',
        'js/owl.carousel.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
