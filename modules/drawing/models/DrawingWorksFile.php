<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingWorksFile extends BaseModel
{
    public $child;
    
    public static function tableName()
    {
        return 'drawings_works_files';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    

}





