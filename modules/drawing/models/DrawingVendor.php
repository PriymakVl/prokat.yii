<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingVendor extends BaseModel
{
    public $catName = 'Производитель';
    public $category = 'vendor';
    
    public static function tableName()
    {
        return 'drawings_vendor';
    }
    
    public static function getAllForObject($obj)
    {
        $drawings = self::find()->where(['code' => $obj->code, 'equipment' => $obj->equipment, 'status' => self::STATUS_ACTIVE])
                ->orderBy(['revision' => SORT_ASC, 'sheet' => SORT_ASC])->all(); 
        return DrawingLogic::cutNotes($drawings);  
    }
    
    public static function check($obj)
    {
        return self::findOne(['code' => $obj->code, 'equipment' => $obj->equipment, 'status' => self::STATUS_ACTIVE]);   
    }

}





