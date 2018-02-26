<?php
namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/media';
    public $css = [
//        'css/styles.css',
		'fonts/font-awesome/css/font-awesome.min.css',
		'fonts/stroke-gap/style.css',
		'css/owl.carousel.css',
		'css/owl.theme.css',
		'css/custom/style.css',
		'css/responsive/responsive.css',
		'css/navbar_orange.css'

    ];
    public $js = [
        'js/scripts.js',

		'js/jquery.mCustomScrollbar.concat.min.js',
		'js/jquery.mCustomScrollbar.concat.min.js',
		'js/jquery.bxslider.min.js',


		'js/jquery.appear.js',
		'js/jquery.countTo.js',
		'js/jquery.fancybox.pack.js',

		'js/owl.carousel.js',
		'js/owl-custom.js',
		'js/custom.js',
		'js/jquery.mixitup.min.js',
		'js/jquery.sliphover.min.js',
//		'js/jquery-3.3.1.min.js',
//		'js/jQuery.scrollSpeed.js',


    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
		'yii\bootstrap\BootstrapThemeAsset',
    ];
}
