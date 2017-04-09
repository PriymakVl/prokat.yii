<?php

namespace app\modules\employees\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\employees\logic\EmployeeLogic;

class Employee extends BaseModel
{
    
    const PAGE_SIZE = 15;
    
    
    public static function tableName()
    {
        return 'employees';
    }
    
    public function behaviors()
    {
    	return ['employee-logic' => ['class' => EmployeeLogic::className()]];
    }
    
    
    
   

}





