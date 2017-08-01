<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class BaseAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/layout.css',
        'css/header.css',
        'css/menu.css',
        'css/footer.css',
        'css/total.css',
    ];
    
    public $js = [
        //'js/vendor/jquery.cookie.js',
        //'js/vendor/jquery.accordion.js',
        //'js/total/list_department_accordion.js',
        'js/total/menu_toggle.js',
        'js/total/table_checked_all.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset', //bootstrap.js
    ];
    
    public $jsOptions = ['position' => View::POS_HEAD];
}
