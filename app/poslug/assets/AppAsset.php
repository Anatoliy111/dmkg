<?php
namespace app\poslug\assets;

$basePath =  dirname(__DIR__);
$webroot = dirname($basePath);

class AppAsset extends \yii\web\AssetBundle
{
//	C:\OpenServer\domains\DMKGtest\vendor\bower\eonasdan-bootstrap-datetimepicker\build\js\bootstrap-datetimepicker.min.js
//    public $sourcePath = '@bower';
	public $sourcePath = '@app/media';


    public $css = [
//        'css/month/jquery-ui.css',
////		'css/month/stylesheet.css',
//		'css/month/MonthPicker.css',
//		'css/month/examples.css',
//		'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
//		'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
//		'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker-standalone.css',
//		'bootstrap/dist/css/bootstrap.min.css',

    ];
    public $js = [

		'js/myscript.js',
//		'js/custom.js',
//		'js/month/jquery.maskedinput.min.js',
//		'js/month/MonthPicker.js',
//		'js/month/examples.js',
//        'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
//		'moment/min/moment.min.js',
//		'jquery/dist/jquery.min.js',
//		'bootstrap/dist/js/bootstrap.min.js',

    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
		'yii\bootstrap\BootstrapThemeAsset',
    ];
}
