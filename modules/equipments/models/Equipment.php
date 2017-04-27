<?php

namespace app\modules\equipments\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\employees\logic\EmployeeLogic;

class Equipment extends BaseModel
{
    
    const PAGE_SIZE = 15;
    const PARENT_ID_AREA = 0;
    
    
    public static function tableName()
    {
        return 'equipments';
    }
    
    public function behaviors()
    {
    	return ['employee-logic' => ['class' => EmployeeLogic::className()]];
    }
    
    public static function getArea()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => self::PARENT_ID_AREA])
                ->orderBy(['rating' => SORT_DESC])->all();
    }
    
    public static function getEquipmentOfArea($area_id)
    {
        return self::find()->select('id, name')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $area_id]) 
            ->asArray()->all();   
    }

    
    
    
   

}





