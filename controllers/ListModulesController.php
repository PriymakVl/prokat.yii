<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\models\Objects;
use app\models\BaseModel;
use app\models\lists\Lists;
use app\models\lists\ListContent;
use app\models\lists\ListType;
use app\models\forms\ListContentForm;
use app\models\forms\ListTypeForm;


class ListModulesController extends BaseController
{
    public $layout = 'base';
    
     public function actionList()
    {
        return $this->render('list');
    }
    

    
    
}