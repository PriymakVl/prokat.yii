<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
//use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\ObjectDrawing; 
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\models\DrawingDanieli;
use app\modules\drawing\models\DrawingStandardDanieli;
use yii\web\UploadedFile;
use app\modules\drawing\logic\DrawingLogic;

class ObjectDrawingForm extends BaseForm
{   
    public $category;
    //public $dwg_id;
    public $code;
    public $file;
    public $dwg;
    public $note;
    public $numberWorksDwg; public $nameWorksDwg; public $sheetWorksDwg;
    public $designerDepartmentDwg;
    public $revisionDanieliDwg; public $sheetDanieliDwg;
    public $nameStandardDanieliDwg;
    //class
    public $obj;
    
    public function rules() {
        return [
            //[['dwg_id'], 'required', 'message' => 'Необходимо указать ID чертежа'],
            [['note', 'numberWorksDwg', 'nameWorksDwg', 'nameStandardDanieliDwg', 'revisionDanieliDwg'], 'string'],
            [['designerDepartmentDwg'], 'string'],
            [['sheetWorksDwg', 'sheetDanieliDwg'], 'integer'],
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
            case 'danieli': return $this->saveDwgDanieli();
            case 'standard': return new DrawingStandard();
            case 'standard_danieli': return $this->saveDwgStandardDanieli();
            default: return false;
        }   
            
    }
    
    private function saveDwgDanieli()
    {
        $this->dwg = new DrawingDanieli();
        $this->dwg->code = $this->dwg->getCodeWithoutVariant($this->obj->code);
        $this->dwg->sheet = $this->sheetDanieliDwg;
        $this->dwg->note = $this->note; 
        $this->dwg->revision = $this->revisionDanieliDwg;
        $file = UploadedFile::getInstance($this, 'file');
        $file->saveAs('files/vendor/danieli/'.$file->name);
        $this->dwg->file = $file->name;
        return $this->dwg->save();
    }
    
    private function saveDwgStandardDanieli()
    {
        $this->dwg = new DrawingStandardDanieli();
        $this->dwg->code = $this->dwg->getCodeWithoutVariant($this->obj->code);
        $this->dwg->name = $this->nameStandardDanieliDwg; 
        $file = UploadedFile::getInstance($this, 'file');
        $file->saveAs('files/standard/danieli/'.$file->name);
        //$this->dwg->file = $file->name;
        return $this->dwg->save();
    }
    
    private function saveDwgDepartment()
    {
        $this->dwg = new DrawingDepartment();
        $this->saveDwgDataTotal();
        $this->dwg->number = DrawingLogic::getNewNumberDepartmentDwg();
        $this->dwg->designer = $this->designerDepartmentDwg;
        $this->dwg->save();
        return $this->saveFile('department', '_depart');
    }
    
    private function saveDwgWorks()
    {
        $dwg = DrawingWorks::findOne(['number' => $this->numberWorksDwg, 'status' => DrawingWorks::STATUS_ACTIVE]);
        $this->dwg = $dwg ? $dwg : new DrawingWorks();
        $this->saveDwgDataTotal();
        $this->dwg->number = $this->numberWorksDwg;
        if ($this->nameWorksDwg) $this->dwg->name = $this->nameWorksDwg;
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
        $this->dwg->date = time();    
    }
    
    private function saveFile($folder, $sufix)
    {
        $file = UploadedFile::getInstance($this, 'file');
        $this->dwg->file = $this->uploadFile($this->dwg->id, $file, $folder, $sufix);
        return $this->dwg->save();
    }
    
//    public function checkNumberDwg($attribute, $params)
//    {
//        if ($this->category == 'works' && !$this->numberDwg) {
//            $this->addError($attribute, 'Необходимо указать номер чертежа');
//        }    
//    }
    
    
    
    

}

