<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
//use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\ObjectDrawing; 

class ObjectDrawingForm extends BaseForm
{   
    public $category;
    public $dwg_id;
    public $code;
    
    public function rules() {
        return [
            [['dwg_id'], 'required', 'message' => 'Необходимо указать ID чертежа'],
            [['dwg_id'], 'integer'],
            [['code'], 'required', 'message' => 'Необходим код детали'],
            [['category'], 'required', 'message' => 'Необходимо указать  кто разработал чертеж'],
        ];
    }

    public function save($obj) 
    {
        if (strpos($obj->code, '/')) $code = explode('/', $code)[0];
        else $code = $obj->code;   
        $item = ObjectDrawing::find()->where(['code' => $item->code, 'category' => $this->category, 'dwg_id' => $this->dwg_id])->one();
        if ($item) {
            $item->status = self::STATUS_ACTIVE;//if ealy remove
            return true;
        }
        else {
            $item = new ObjectDrawing();
            $item->category = $this->category;
            $item->dwg_id = $this->dwg_id;
            $item->code = $code;
            return $item->save();    
        }
    }
    
    

}

