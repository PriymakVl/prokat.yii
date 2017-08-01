<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\modules\drawing\models\DrawingVendor;
//use app\modules\objects\models\ObjectDrawing; 

class ObjectDrawingVendorForm extends BaseForm
{   
    public $file;

    
    public function rules() {
        return [
            [['file'], 'required', 'message' => 'Поле обязательное для заполнения'],
            [['file'], 'string'],
        ];
    }


    
    public function save($obj) 
    {
        $dwg = new DrawingVendor();
		$dwg->code = $obj->code;
		$dwg->equipment = $obj->equipment;
		$dwg->file = $this->file;
        return $dwg->save();
    }
    

}

