<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingSundbirsta extends BaseModel
{
    public $catName = 'Sundbirsta';
    public $category = 'sundbirsta';
    
    public static function tableName()
    {
        return 'drawings_sundbirsta';
    }
    
    public static function getAllForObject($obj)
    {
        $drawings = self::find()->where(['code' => $obj->code, 'status' => self::STATUS_ACTIVE])->all();  
        return DrawingLogic::cutNotes($drawings);  
    }
    
}





