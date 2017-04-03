<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use app\models\Tag;
use app\modules\drawing\models\DrawingVendor;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\models\DrawingStandard;
use app\modules\drawing\logic\DrawingLogic;

class DrawingForm extends BaseForm
{   
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    public static function getDrawing($dwg_id, $dwg_cat)
    {
        if ($dwg_cat == 'department') return DrawingDepartment::findOne($dwg_id);
        if ($dwg_cat == 'vendor') return DrawingVendor::findOne($dwg_id);
        if ($dwg_cat == 'works') return DrawingWorks::findOne($dwg_id);
        if ($dwg_cat == 'standard') return DrawingStandard::findOne($dwg_id);
        else return false;
    }
    
}

