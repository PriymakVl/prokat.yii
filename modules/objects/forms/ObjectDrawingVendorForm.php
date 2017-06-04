<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
//use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\ObjectDrawing; 

class ObjectDrawingVendorForm extends BaseForm
{   
    public $sheet;
    public $revision;
    
    public function rules() {
        return [
            [['sheet'], 'required', 'message' => 'Необходимо указать лист чертежа'],
            [['sheet'], 'integer'],
            [['revision'], 'string'],
            [['revision'], 'required', 'message' => 'Необходимо указать номер доработки'],
        ];
    }


    
    public function save($dwg) 
    {
        $dwg->revision = $this->revision;
        $dwg->sheet = $this->sheet;
        return $dwg->save();
    }
    

}

