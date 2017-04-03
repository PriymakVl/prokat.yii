<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\models\drawings\Teg;

class MainadminController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex() 
    {   
        return $this->render('index');
    }
    
}