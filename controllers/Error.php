<?php

namespace app\controllers;

use Yii;
use yii\helpers\StringHelper;
use app\controllers\BaseController;


class ErrorController extends BaseController 
{
          
    public function actionIndex() 
    {   
        debug('error');
        return $this->render('index', ['objects' => $objects]);
    }
    
    
}