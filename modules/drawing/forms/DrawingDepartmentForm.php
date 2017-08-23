<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\logic\DrawingLogic;
use app\models\Tag;

class DrawingDepartmentForm extends DrawingForm
{   
    //public $name;
    public $designer;
    public $service;
    //public $type;
    public $note;
    public $file;
    public $file_cdw;
    //public $parent_id;
	//public $alias;
    //form
    //public $dwg_id; 
    public $types; public $equipments; public $dwg;
    //object
    public $obj_note; public $obj_code; public $obj_rus; public $obj_id; public $obj_qty; public $obj_item;
    public $obj_parent_id; public $obj_weight; public $obj_alias; public $obj_type; public $obj_equipment;
    public $order_name;  
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название чертежа'],
            ['type', 'default', 'value' => 'file'],
            ['parent_id', 'default', 'value' => 0],
            ['service', 'default', 'value' => 'mech'],
            //['note', 'default', 'value' => ''],
            [['designer', 'note', 'alias'], 'default', 'value' => ''],
            ['file', 'file', 'extensions' => ['pdf', 'tif', 'jpg']],
            ['file_cdw', 'file', 'extensions' => ['cdw'], 'message' => \Yii::t('app', 'Только файлы программы Компас')],
            [['alias', 'obj_alias', 'obj_rus', 'obj_code', 'obj_note', 'obj_weight', 'order_name', 'obj_type'], 'string'],
            [['obj_equipment'], 'string'],
            [['obj_id', 'obj_parent_id', 'obj_item', 'obj_qty'], 'integer'],
        ];

    }


    public function save($dwg) 
    {
        $this->saveDrawing($dwg);
        $this->saveFile();
        $obj = $this->saveObject();
        $this->saveDrawingForObject($obj);
        return true;  
    }
    
    public function getTypes()
    {
        $this->types = Tag::get('object');
        return $this;
    }
    
    public function getEquipments()
    {
        $this->equipments = Tag::get('equipment');
        return $this;
    }
    
    private function saveDrawing($dwg)
    {
        if ($dwg) $this->dwg = $dwg;
        $this->dwg = new DrawingDepartment();
        
        //$this->dwg->type = $this->type;
        //$this->dwg->name = $this->name;
		//$this->dwg->alias = $this->alias;
        $this->dwg->designer = $this->designer;
        //$this->dwg->parent_id = $this->parent_id;
        $this->dwg->note = $this->note;
        //$this->dwg->service = $this->service;
        $this->dwg->date = time();
        $this->dwg->year = date('Y', time());
        $this->dwg->save(); 
    }
    
    private function saveFile()
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        if (!$this->file) return;
        $this->dwg->file = $this->uploadFile($this->dwg->id, $this->file, 'department', '_depart');
        //file compas
        //$this->file_cdw = UploadedFile::getInstance($this, 'file_cdw');
//        $dwg->file_cdw = $this->uploadFile($dwg->id, $this->file_cdw, 'department', '_depart_kompas'); 
        //if ($dwg->file || $dwg->file_cdw) $dwg->save(); 
        $this->dwg->save();   
    }
    
    private function saveObject()
    {
        $obj = Objects::getOne($this->obj_id, null, self::STATUS_ACTIVE);
        if (!$obj) $obj = new Objects();
        $obj->rus = $this->obj_rus ? $this->obj_rus : $this->name;
        $obj->alias = $this->obj_alias ? $this->obj_alias : $this->alias;
        $obj->parent_id = $this->obj_parent_id ? $this->obj_parent_id : 0;
        $obj->type = $this->obj_type;
        $obj->equipment = $this->obj_equipment;
        $this->dwg->getNumber();
        $obj->code = $this->obj_code ? $this->obj_code : $this->dwg->number;
        $obj->weight = $this->obj_weight;
        $obj->item = $this->obj_item;
        $obj->qty = $this->obj_qty;
        $obj->save();
        $this->dwg->obj_id = $obj->id;
        $this->dwg->save();
        return $obj;
    }
    
    private function saveDrawingForObject($obj)
    {
        $dwg_id = $this->dwg->id;
        $sql = "INSERT INTO `drawings_object` (`category`, `dwg_id`, `code`) VALUES ('department', $dwg_id, $obj->code)";
        return \Yii::$app->db->createCommand($sql)->execute();
    }
    
    
    

}

