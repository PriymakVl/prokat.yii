<?php

namespace app\modules\order\forms;

use yii\web\UploadedFile;
use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\OrderContent;
use app\modules\objects\models\Objects;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;
use app\classes\WeightDetail;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;

class OrderContentForm extends BaseForm
{   
    const STATUS_DRAFT = 2;
    
    public $name;
    public $drawing;
    public $weight;
    public $note;
    public $rating;
    public $item;
    public $count;
    public $material;
    public $material_add;
    public $order_id;
    public $code;
    public $obj_id;
    public $cat_dwg;
    public $type_dwg;
    public $filename;
    public $file;
    public $sheet;
    public $variant;
    public $delivery;
    public $dimensions;
    //form
    public $element;
    public $newNumberDepartmentDwg;
    public $newFullNumberDepartmentDwg;
    public $item_id;
    public $type_dimensions;
    public $nut_thread; public $nut_pitch; public $nut_class;
    public $bolt_thread; public $bolt_pitch; public $bolt_length; public $bolt_class;
    public $shaft_length; public $shaft_diam;
    public $bush_height; public $bush_in_diam; public $bush_out_diam;
    public $bar_height; public $bar_width; public $bar_length;

    public function __construct($element)
    {
        parent::__construct();
        if (is_object($element)) $this->element = $element;
        else $this->element = new OrderContent();      
    }
    
    public function rules() 
    {
        return [
            ['name', 'required', 'message' => 'Необходимо заполнить поле'],
            ['name', 'string', 'length' => [2, 40]],
            [['type_dimensions', 'cat_dwg', 'code', 'type_dwg', 'filename', 'material_add'], 'string'],
            [['note', 'material', 'variant', 'file', 'weight', 'drawing', 'bolt_class', 'nut_class', 'bolt_pitch'], 'string'],
            [['order_id', 'nut_thread', 'nut_pitch', 'bolt_thread', 'bolt_length'], 'integer'],
            [['shaft_length', 'shaft_diam', 'bush_height', 'bush_in_diam', 'bush_out_diam'], 'integer'],
            [['bar_length', 'bar_height', 'bar_width'], 'integer'],
            [['count', 'item', 'rating', 'obj_id', 'delivery',], 'default', 'value' => 0],
            ['sheet', 'default', 'value' => 1],
            ['file', 'file', 'extensions' => ['tif', 'jpg', 'pdf']],
        ];
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }

  public function save()
    {
        $this->element->name = $this->name;     
        $this->element->note = $this->note;
        $this->element->count = $this->count;
        $this->element->rating = $this->rating;
        $this->element->order_id = $this->order_id; 
        $this->element->material = $this->material;
        $this->element->material_add = $this->material_add;
        $this->element->item = $this->item;
        $this->dimensions = ObjectLogic::setDimensions($this);
        if ($this->dimensions) $this->element->dimensions = serialize($this->dimensions);
        $this->element->weight = $this->getWeight();
        $this->element->obj_id = $this->obj_id;
        //drawing
        $this->setDrawing();
        
        $this->element->delivery = $this->delivery;
        $this->element->variant = $this->variant;
        if ($this->element->code || $this->element->obj_id) $this->saveParamsForObjects();
        $this->element->save();
        return true;
    }
  
    private function saveParamsForObjects()
    {
        if (!$this->element->code) $this->element->code = Objects::find()->select('code')->where(['id' => $this->element->obj_id])->column()[0]; 
        $objects = Objects::findAll(['code' => $this->element->code, 'status' => Objects::STATUS_ACTIVE]);
        foreach ($objects as $obj) {
            if ($this->element->name) {
                if ($obj->id == $obj_id) $obj->order_name = $this->element->name;
                else if (!$obj->order_name) $obj->order_name = $this->element->name;    
            }
            if ($this->element->dimensions) $obj->dimensions = $this->element->dimensions;
            if (!$obj->weight && $this->element->weight) $obj->weight = $this->element->weight;
            $obj->save();
        }  
    }
    
    private function setDrawing()
    {
        $this->element->drawing = $this->drawing;   
        $this->element->sheet = $this->sheet;  
        $this->element->cat_dwg = $this->cat_dwg; 
        if ($this->filename) $this->element->file = $this->filename; 
        if ($this->type_dwg == 'new') {
            $obj = $this->saveObject();
            $this->element->file = $this->saveDrawing($obj);
        } 
    }
    
    private function getWeight()
    {
        if ($this->weight) return $this->weight;
        else if ($this->dimensions) return WeightDetail::calculate($this->dimensions, $this->material);
        return null;    
    }
    
    public function saveDrawing($obj) 
    {
        switch($this->cat_dwg) {
            case 'department': return $this->saveDwgDepartment($obj);
            case 'works': return $this->saveDwgWorks($obj);
            //case 'danieli': return $this->saveDwgDanieli();
            //case 'standard': return new DrawingStandard();
            //case 'standard_danieli': return $this->saveDwgStandardDanieli();
            default: return false;
        }       
    }

    
    private function saveDwgDepartment($obj)
    {
        $dwg = new DrawingDepartment();
        $dwg->obj_id = $obj->id;
        $dwg->code = $obj->code;
        $dwg->date = time();
        $dwg->number = $this->newNumberDepartmentDwg;
        $dwg->name = $obj->rus;
        $dwg->save();
        $file = UploadedFile::getInstance($this, 'file');
        if ($file) $dwg->file = $this->uploadFile($dwg->id, $file, 'department', '_depart');
        $dwg->save();
        return $dwg->file;
    }
    
    private function saveDwgWorks($obj)
    {
        $dwg = new DrawingWorks();
        $dwg->obj_id = $obj->id;
        $dwg->code = $obj->code;
        //$dwg->parent_id = $obj->parent_id;
        $dwg->date = time();
        $dwg->number = $this->drawing;
        $dwg->name = $obj->rus;
        $dwg->save();
        $file = UploadedFile::getInstance($this, 'file');
        if ($file) $dwg->sheet_1 = $this->uploadFile($dwg->id, $file, 'works', '_works_1');
        $dwg->save();
        return $dwg->sheet_1;
    }

    
    private function saveObject() 
    {
        $obj = new Objects();
        $obj->rus = $this->name;
        $obj->alias = $this->name;
        $obj->order_name = $this->name;
        $obj->parent_id = 22821;
        $obj->weight = $this->weight;
        $obj->dimensions = $this->dimensions;
        $obj->save();
        $obj->code = $obj->id.'-code';
        $obj->save();
        $this->element->obj_id = $obj->id;
        $this->element->code = $obj->code;
        return $obj;    
    }
    
    public function getNewNumberDepartmentDwg()
    {
        $this->newNumberDepartmentDwg = DrawingLogic::getNewNumberDepartmentDwg();
        $year = date('y');
        $this->newFullNumberDepartmentDwg = '27.'.$this->newNumberDepartmentDwg.'.'.$year;
        return $this;
    }

//    private function getObject() 
//    {
//        $obj = null;
//        if ($this->obj_id) $obj = Objects::getOne($obj_id);
//        else if ($this->drawing) $obj = Objects::findOne(['code' => $this->drawing, 'status' => self::STATUS_ACTIVE]); 
//        if ($obj) $obj->getName();  
//        return $obj; 
//    }




}

