<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\models\BaseModel;
use app\modules\objects\models\Objects;
use app\models\Tag;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;

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
    public $material;
    public $analog;
    //drawing
    public $dwg;
    public $categoryDwg;
    public $noteDwg;
     //works dwg
    public $numberWorksDwg; public $nameWorksDwg; 
    public $works_dwg_1; public $works_dwg_2; public $works_dwg_3;
    //department dwg
    public $designerDepartmentDwg; public $department_draft; public $department_kompas; public $nameDepartmentDwg;
    
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
            [['alias', 'code', 'weight', 'note', 'all_name', 'material', 'analog'], 'string'],
            [['parent_id', 'item', 'rating'], 'default', 'value' => 0],
            ['qty', 'default', 'value' => 1],
            //drawing
            [['categoryDwg', 'nameDepartmentDwg', 'nameWorksDwg', 'designerDepartmentDwg', 'noteDwg', 'numberWorksDwg'], 'string'],
            [['works_dwg_1', 'works_dwg_2', 'works_dwg_3', 'department_draft'], 'file', 'extensions' => ['tif', 'jpg', 'jpeg', 'pdf']],
            ['department_kompas', 'file', 'extensions' => 'cdw'],
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
        $this->obj->code = trim($this->code); 
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
        $this->obj->material = $this->material;
        $this->obj->analog = $this->analog;
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
        else if ($this->categoryDwg == 'works') return DrawingWorks::saveDwg($this, $this->obj);
        else if ($this->categoryDwg == 'department') DrawingDepartment::saveDwg($this, $this->obj);
        else return false;
    }

}









