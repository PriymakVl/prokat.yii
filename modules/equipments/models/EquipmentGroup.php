<?php

namespace app\modules\equipments\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\equipments\logic\EquipmentLogic;

class EquipmentGroup extends BaseModel
{
    
    const PAGE_SIZE = 15;
    const PARENT_ID_INITIAL_AREA = 0;
    
    
    public static function tableName()
    {
        return 'equipment_groups';
    }
    
    public function behaviors()
    {
    	return ['equipment-logic' => ['class' => EquipmentLogic::className()]];
    }
    
    public static function getGroups()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => self::PARENT_ID_INITIAL_AREA])->orderBy(['rating' => SORT_DESC])->all();
    }
    
    public static function getSubgroup($group_id)
    {
        return self::find()->select('id, name, alias, inventory')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $group_id])->asArray()->all();
    }
    
    public static function getUnits($subgroup_id)
    {
        return self::find()->select('id, name, alias')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $subgroup_id])->asArray()->all();
    }

    
    
    
   

}





