<?php

namespace app\modules\applications\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\applications\logic\ApplicationLogic;

class ApplicationProduct extends BaseModel
{
    
    public static function tableName()
    {
        return 'application_products_test';
    }
    
    public function behaviors()
    {
    	return ['application-logic' => ['class' => ApplicationLogic::className()]];
    }
    
}





