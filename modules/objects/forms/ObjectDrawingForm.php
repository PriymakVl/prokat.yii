<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
//use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\ObjectDrawing; 
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use yii\web\UploadedFile;

class ObjectDrawingForm extends BaseForm
{   
    public $category;
    //public $dwg_id;
    public $code;
    public $file;
    public $dwg;
    public $numberDwg;
    public $nameDwg;
    public $sheetDwg;
    public $note;
    //class
    public $obj;
    
    public function rules() {
        return [
            //[['dwg_id'], 'required', 'message' => 'Необходимо указать ID чертежа'],
            [['note', 'numberDwg', 'nameDwg'], 'string'],
            ['sheetDwg', 'integer'],
            [['category'], 'required', 'message' => 'Необходимо указать  где создан чертеж'],
            //['numberDwg', 'checkNumberDwg',  'skipOnError' => false],
            ['file', 'file', 'extensions' => ['tif', 'jpg', 'pdf']],
        ];
    }

    public function save($obj) 
    {
        $this->obj = $obj;
        switch($this->category) {
            case 'department': return $this->saveDwgDepartment();
            case 'works': return $this->saveDwgWorks();
            case 'vendor': return new DrawingVendor();
            case 'standard': return new DrawingStandard();
            case 'standard_danieli': return new DrawingStandardDanieli();
            default: return false;
        }   
            
    }
    
    private function saveDwgDepartment()
    {
        $this->dwg = new DrawingDepartment();
        $this->saveDwgDataTotal();
        $this->dwg->number = $this->setNumberDepartmentDwg();
        //$this->dwg->year = date('Y', time());
        $this->dwg->save();
        return $this->saveFile('department', '_depart');
    }
    
    private function saveDwgWorks()
    {
        $this->dwg = new DrawingWorks();
        $this->saveDwgDataTotal();
        $this->dwg->number = $this->numberDwg;
        $this->dwg->name = $this->nameDwg;
        $this->dwg->parent_id = $this->obj->parent_id;
        if ($this->sheetDwg) $this->dwg->sheet = $this->sheetDwg;
        $this->dwg->save();
        return $this->saveFile('works', '_works');    
    }
    
    private function saveDwgDataTotal()
    {
        $this->dwg->obj_id = $this->obj->id;
        $this->dwg->code = $this->obj->code;
        $this->dwg->note = $this->note; 
        $this->dwg->date = time();    
    }
    
    private function saveFile($folder, $sufix)
    {
        $file = UploadedFile::getInstance($this, 'file');
        $this->dwg->file = $this->uploadFile($this->dwg->id, $file, $folder, $sufix);
        return $this->dwg->save();
    }
    
    private function setNumberDepartmentDwg()
    {
        $current_year = date('Y');
        $tableName = $this->dwg->tableName();
        $sql = "SELECT `id` FROM $tableName ORDER BY `id` DESC LIMIT 1";
        $last_id = \Yii::$app->db->createCommand($sql)->queryScalar();
        if ($last_id === false) return 1; //if in database not records;
        $last_dwg = DrawingDepartment::getOne($last_id, null, DrawingDepartment::STATUS_ACTIVE);
        if (!$last_dwg) $last_dwg = DrawingDepartment::getOne(($last_id - 1), null, DrawingsDepartment::STATUS_ACTIVE);//если последний удален
        if ($current_year == date('Y', $last_dwg->date)) return $last_dwg->number + 1;
        else if ($current_year > $last_dwg->year) return 1;
    }
    
//    public function checkNumberDwg($attribute, $params)
//    {
//        if ($this->category == 'works' && !$this->numberDwg) {
//            $this->addError($attribute, 'Необходимо указать номер чертежа');
//        }    
//    }
    
    
    
    

}

