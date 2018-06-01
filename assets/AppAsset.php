<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
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
        'js/total/table_checked_all.js',
        'js/total/first_input_form_focus.js',
        'js/total/message_remove.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset', //bootstrap.js
    ];
    
    public $jsOptions = ['position' => View::POS_HEAD];
}
