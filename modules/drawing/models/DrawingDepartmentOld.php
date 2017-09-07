<?php

namespace app\modules\drawing\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartmentOld extends BaseModel
{

    
    public static function tableName()
    {
        return 'drawings_department_old';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    
}





