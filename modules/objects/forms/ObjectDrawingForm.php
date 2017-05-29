<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\modules\drawing\logic\DrawingLogic;
use app\models\Tag;

class ObjectDrawingForm extends BaseForm
{   
    public $category;
    public $dwg_id;
    //form
    public $categories;
    
    public function rules() {
        return [
            [['dwg_id'], 'required', 'message' => 'Необходимо указать ID чертежа'],
            [['category'], 'required', 'message' => 'Необходимо указать  кто разработал чертеж'],
        ];
    }

    public function save($obj) 
    {
        if ($dwg->category == 'vendor') $dwg = $this->updateDataVendor();
        else {
            $dwg = DrawingLogic::getDrawingObject($this->category, $this->dwg_id);
            $dwg->obj_id = $obj->id;
            $dwg->equipment = $obj->equipment;
            if ($obj->code) $dwg->code = $obj->code;    
        }
        return $dwg->save();
    }
    
    public function getCategories()
    {
        $this->categories = Tag::get('drawing');
        return $this;
    }
    
    private function updateDataVendor()
    {
        $dwg = DrawingVendor::getDrawignByNameFile($this->file_vendor_name);
        if (!$dwg->code) $dwg->code = $obj->code;
        $dwg->revision = $this->file_vendor_revision;
        $dwg->sheet = $this->file_vendor_sheet;
        return $dwg;
    }

}

