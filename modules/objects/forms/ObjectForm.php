<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\modules\objects\models\Objects;
use app\models\Tag;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use yii\web\UploadedFile;
use app\modules\drawing\logic\DrawingLogic;

class ObjectForm extends BaseForm
{
    //table database
    public $parent_id; public $rus; public $eng; public $alias; public $note; public $type; public $equipment; public $weight; public $code; public $rating;
    public $order_name; public $material; public $analog;public $qty; public $item;
    //drawing
    public $dwg; public $categoryDwg; public $noteDwg;
     //drawing works
    public $numberWorksDwg; public $nameWorksDwg; public $works_dwg_1; public $works_dwg_2; public $works_dwg_3;
    //drawing department
    public $designerDepartmentDwg; public $department_draft; public $department_kompas; public $nameDepartmentDwg; public $numberDepartmentDwg; public $newNumberDepartmentDwg;
    //form
    public $types; public $equipments; public $all_name; public $obj;
    
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
            [['categoryDwg', 'nameDepartmentDwg', 'nameWorksDwg', 'designerDepartmentDwg', 'noteDwg', 'numberWorksDwg', 'numberDepartmentDwg'], 'string'],
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
        else if ($this->categoryDwg == 'works') return $this->saveDwgWorks();
        else if ($this->categoryDwg == 'department') return $this->saveDwgDepartment();
        else return false;
    }

    public function saveDwgWorks()
    {
        $dwg = new DrawingWorks();
        $dwg->code = $this->obj->code;
        $dwg->parent_id = 0;
        $dwg->note = $this->noteDwg;
        $dwg->date = time();
        $dwg->number = $this->numberWorksDwg;
        $dwg->name = $this->nameWorksDwg;
        $dwg->save();
        $sheet_1 = $this->uploadFileWorks(1, $dwg);
        $sheet_2 = $this->uploadFileWorks(2, $dwg);
        $sheet_3 = $this->uploadFileWorks(3, $dwg);
        if ($sheet_1) $dwg->sheet_1 = $sheet_1;
        if ($sheet_2) $dwg->sheet_2 = $sheet_2;
        if ($sheet_3) $dwg->sheet_3 = $sheet_3;
        return $dwg->save();
    }

    private function uploadFileWorks($number, $dwg)
    {
        $file = UploadedFile::getInstance($this, 'works_dwg_'.$number);
        if (!$file) return null;
        $filename = $dwg->id.'_works_'.$number.'.'.$file->extension;
        $file->saveAs('files/works/'.$filename);
        return $filename;
    }

    public function saveDwgDepartment()
    {
        $dwg = new DrawingDepartment();
        $dwg->number = $this->numberDepartmentDwg;
        $dwg->designer = $this->designerDepartmentDwg;
        $dwg->date = time();
        $dwg->year = date('Y');
        $dwg->name = $this->nameDepartmentDwg;
        $dwg->code = $this->obj->code;
        $dwg->note = $this->noteDwg;
        $dwg->save();
        $dwg->file = $this->uploadFileDraft($dwg);
        $dwg->file_cdw = $this->uploadFileKompas($dwg);
        return $dwg->save();
    }

    private function uploadFileDraft($dwg)
    {
        $file = UploadedFile::getInstance($this, 'department_draft');
        if (!$file) return null;
        $filename = $dwg->id.'_draft.'.$file->extension;
        $file->saveAs('files/department/'.$filename);
        return $filename;
    }

    private function uploadFileKompas($dwg)
    {
        $file = UploadedFile::getInstance($this, 'department_kompas');
        if (!$file) return null;
        $filename = $dwg->id.'_kompas.'.$file->extension;
        $file->saveAs('files/department/kompas/'.$filename);
        return $filename;
    }

    public function getNewNumberDepartmentDwg()
    {
        $this->newNumberDepartmentDwg = DrawingLogic::getNewNumberDepartmentDwg();
        return $this;
    }

}









