<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\models\BaseModel;
use app\modules\objects\models\Objects;
use app\models\Tag;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use yii\web\UploadedFile;
use app\modules\drawing\logic\DrawingLogic;

class ObjectForm extends BaseForm
{   
    public $obj;
    public $parent_id;
    public $rus;
    public $eng;
    public $alias;
    public $note;
    public $type;
    public $equipment;
    public $weight;
	public $qty; //count objects
    public $code;
    public $rating;
    public $item; //position object in specification
    public $order_name;
    //drawing
    public $dwg;
    public $categoryDwg;
    public $nameDwg;
    public $fileDwg;
    public $numberWorksDwg;
    public $sheetWorksDwg;
    public $designerDepartmentDwg;
    public $fileDwgKompas;
    public $noteDwg;
    //form
    public $types;
    public $equipments;
	public $all_name;
    
    public function __construct($obj)
    {
        if ($obj) $this->obj = $obj;
        else $this->obj = new Objects;
    }
    
    public function rules() {
        return [
            [['rus'], 'required', 'message' => 'Необходимо указать название объекта'],
            [['type'], 'required', 'message' => 'Необходимо указать  тип объекта'],
            [['equipment'], 'required', 'message' => 'Необходимо указать оборудование объекта'],
            ['order_name', 'string', 'length' => [2, 40] ],
            [['alias', 'code', 'weight', 'note', 'all_name'], 'string'],
            [['parent_id', 'item', 'rating'], 'default', 'value' => 0],
            ['qty', 'default', 'value' => 1],
            //drawing
            [['categoryDwg', 'nameDwg', 'designerDepartmentDwg', 'noteDwg', 'numberWorksDwg'], 'string'],
            ['sheetWorksDwg', 'integer'],
            ['sheetWorksDwg', 'default', 'value' => 1],
            ['fileDwg', 'file', 'extensions' => ['tif', 'jpg', 'jpeg', 'pdf']],
            ['fileDwgKompas', 'file', 'extensions' => ['cdw']],
        ];
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
    
    public function save()
    {   
        if (!$this->code) $this->obj->code = trim($this->code); 
        $this->obj->parent_id = $this->parent_id;
        $this->obj->rus = $this->rus;
		if ($this->all_name && $this->rus && $this->code != '') $this->changeNameAllObjects();
        $this->obj->alias = $this->alias;
        $this->obj->note = $this->note;
        $this->obj->type = $this->type;
		$this->obj->weight = $this->weight;
		$this->obj->qty = $this->qty;
        $this->obj->equipment = $this->equipment;
        $this->obj->item = $this->item;
        $this->obj->rating = $this->rating;
        $this->obj->order_name = $this->order_name;
        $this->obj->save(); 
        if (!$this->obj->code) {
            $this->obj->code = $this->obj->id.'-code';
            $this->obj->save();    
        }  
        $this->saveDrawing();
        return true;           
    }
	
	public function changeNameAllObjects() {
		$objects = Objects::findAll(['code' => $this->code, 'status' => self::STATUS_ACTIVE]);
		if (!$objects) return;
		foreach ($objects as $obj) {
			$obj->rus = $this->rus;
			if ($this->alias) $obj->alias = $this->alias;
            if ($this->order_name) $obj->order_name = $this->order_name;
			$obj->save();
		}
	}
    
    private function saveDrawing()
    {
        if (!$this->categoryDwg) return false;
        else if ($this->categoryDwg == 'works') return $this->saveDwgWorks();
        else if ($this->categoryDwg == 'department') return $this->saveDwgDepartment();
        else return false;
    }
    
    private function saveDwgWorks()
    {
        $dwg = DrawingWorks::findOne(['number' => $this->numberWorksDwg, 'status' => DrawingWorks::STATUS_ACTIVE]);
        $this->dwg = $dwg ? $dwg : new DrawingWorks();
        $this->saveDwgDataTotal();
        $this->dwg->number = $this->numberWorksDwg;
        $this->dwg->parent_id = $this->obj->parent_id;
        $this->dwg->save();
        
        $file = UploadedFile::getInstance($this, 'file');
        if ($file) {
            
            $sheet = $this->sheetWorksDwg ? $this->sheetWorksDwg : 1;
            $sufix = '_works_'.$sheet;
            $filename = $this->uploadFile($this->dwg->id, $file, 'works', $sufix);
            $this->dwg = DrawingLogic::saveFileWorks($this->dwg, $sheet, $filename);     
        }
        return $this->dwg->save();;   
    }
    
    private function saveDwgDataTotal()
    {
        $this->dwg->obj_id = $this->obj->id;
        $this->dwg->code = $this->obj->code;
        if ($this->note) $this->dwg->note = $this->note; 
        if ($this->nameDwg) $this->dwg->name = $this->nameDwg;
        $this->dwg->date = time();    
    }
    
    private function saveFile($folder, $sufix)
    {
        $file = UploadedFile::getInstance($this, 'fileDwg');
        if (!$file) return false;
        $this->dwg->file = $this->uploadFile($this->dwg->id, $file, $folder, $sufix);
        return $this->dwg->save();
    }
    
    private function saveFileKompas()
    {
        $file = UploadedFile::getInstance($this, 'fileDwgKompas');
        if (!$file) return false;
        $this->dwg->file_cdw = $this->uploadFile($this->dwg->id, $file, 'department/kompas', '_kompas');
        return $this->dwg->save();
    }
    
    private function saveDwgDepartment()
    {
        $this->dwg = new DrawingDepartment();
        $this->saveDwgDataTotal();
        $this->dwg->number = DrawingLogic::getNewNumberDepartmentDwg();
        $this->dwg->designer = $this->designerDepartmentDwg;
        $this->dwg->save();
        $this->saveFileKompas();
        return $this->saveFile('department', '_depart');
    }

}









