<?php

namespace app\modules\equipments\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\equipments\logic\EquipmentLogic;

class Equipment extends BaseModel
{
    
    const PAGE_SIZE = 15;
    const PARENT_ID_INITIAL_AREA = 0;
    
    public static function tableName()
    {
        return 'equipments';
    }
    
    public function behaviors()
    {
    	return ['equipment-logic' => ['class' => EquipmentLogic::className()]];
    }
    
    public static function getSections()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => self::PARENT_ID_INITIAL_AREA])->orderBy(['rating' => SORT_DESC])->all();
    }

    //get array for select html
    public static function getArrayByParentId($parent_id)
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->orderBy(['rating' => SORT_DESC])->asArray()->all();
    }
    
    
    
   

}





