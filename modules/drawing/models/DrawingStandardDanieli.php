<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingStandardDanieli extends BaseModel
{
    public $catName = 'Стандарт';
    public $category = 'standard_danieli';
    public $sheet;
    public $sheets;
    public $revision = 'нет';
    public $equipment = 'danieli';
    
    public static function tableName()
    {
        return 'drawings_standard_danieli';
    }
    
    public static function getAllForObject($obj)
    {
        $drawings = [];
        if ($obj->equipment == 'danieli') {
            $code = $obj->getCodeWithoutVariant($obj->code);
            $drawings = self::findAll(['code' => $code, 'status' => self::STATUS_ACTIVE]);    
        }
        return $drawings;
    }
    
    public static function check($obj)
    {
        if ($obj->equipment == 'danieli') {
            $code = $obj->getCodeWithoutVariant($obj->code);
            return self::findAll(['code' => $code, 'status' => self::STATUS_ACTIVE]);    
        }   
    }

}





