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
		$code = self::getCodeWithoutDash($obj->code);
        $drawings = self::find()->where(['code' => $code, 'equipment' => $obj->equipment, 'status' => self::STATUS_ACTIVE])
                ->orderBy(['revision' => SORT_ASC, 'sheet' => SORT_ASC])->all(); 
        return DrawingLogic::cutNotes($drawings);  
    }
    
    public static function check($obj)
    {
        $code = self::getCodeWithoutDash($obj->code);
        return self::findOne(['code' => $code, 'equipment' => $obj->equipment, 'status' => self::STATUS_ACTIVE]);   
    }
    
    public static function getCodeWithoutDash($code) 
    {
        if ( strpos($code, '-')) return substr(str_replace('-', '', $code), 6);//removes unwanted characters
		else return $code;    
    }

}





