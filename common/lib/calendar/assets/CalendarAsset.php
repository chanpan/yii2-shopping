<?php
namespace appxq\calendar\assets;

use yii\web\AssetBundle;

class CalendarAsset extends AssetBundle
{
    public $sourcePath='@lib/calendar/assets';

    public $css=[
	'css/calendar.css',
	'css/dailog.css',
	'css/dp.css',
	'css/alert.css',
	'css/main.css',
    ];

    public $js=[
	'js/Common.js',
	'js/jquery.alert.js',
	'js/wdCalendar_lang_TH.js',
	'js/jquery.calendar.js',
	'js/gcalendar.js',
    ];
    
    public $depends=[
	'yii\web\YiiAsset',
	'appxq\calendar\assets\MigrateAsset',
    ];
}
