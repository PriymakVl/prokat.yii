<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\classes\interfaces\ConfigApp;
use app\classes\traits\CommonStaticMethods;

class BaseController extends Controller implements ConfigApp
{

    public $layout = 'base';
    
    use CommonStaticMethods;
    
    public function behavior()
    {
        return ['base-logic' => ['class' => BaseLogic::className()]];
    }
    
    
}
