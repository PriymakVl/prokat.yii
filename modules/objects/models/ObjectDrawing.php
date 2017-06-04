<?php

namespace app\modules\objects\models;

use Yii;
use yii\helpers\StringHelper;
use yii\helpers\ArrayHelper;
use app\models\BaseModel;
use app\modules\objects\logic\ObjectLogic;
use app\logic\BaseLogic;

class ObjectDrawing extends BaseModel
{

    
    public function behaviors()
    {
        return ['object-logic' => ['class' => ObjectLogic::className()]];
    }

    public static function tableName()
    {
        return 'drawings_object';
    }
    
   
}





