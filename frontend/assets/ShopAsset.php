<?php
namespace frontend\assets;
use yii\web\AssetBundle;

class ShopAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'cssShop/style.css',
        'css/style.css',
        'cssShop/responsive.css',
        'cssShop/owl.carousel.css',
        'cssShop/widgets/style.css',
        'cssShop/plugins/jquery-ui.min.css',
        'cssShop/plugins/swiper.min.css',
        'cssShop/plugins/jquery.fancybox.min.css',
    ];
    public $js = [
        'jsShop/owl.carousel.min.js',
        'jsShop/main.js',
        'jsShop/jquery.sticky.js',
        'jsShop/jquery.easing.1.3.min.js',
        'jsShop/plugins/jquery-ui.min.js',
        'jsShop/plugins/jquery.akordeon.js',
        'jsShop/plugins/jquery.cookie.js',
        'jsShop/plugins/swiper.min.js',
        'jsShop/plugins/jquery.fancybox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}