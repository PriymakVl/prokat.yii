<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;

class DrawingStandard extends BaseModel
{ 
    
    public static function tableName()
    {

        return 'drawings_standard';

    }
    
    public static function getAllForObject($obj)
    {
        return self::find()->where(['code' => $obj->code, 'status' => self::STATUS_ACTIVE])->all();
    }

}





