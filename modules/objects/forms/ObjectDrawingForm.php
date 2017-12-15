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
    public $code;
    public $dwg;
    public $noteDwg;
    //works
    public $numberWorksDwg; public $nameWorksDwg; 
    public $works_dwg_1; public $works_dwg_2; public $works_dwg_3;
    //department
    public $designerDepartmentDwg; public $department_draft; public $department_kompas; public $nameDepartmentDwg;
    //danieli
    public $revisionDanieliDwg; public $sheetDanieliDwg;
    public $nameStandardDanieliDwg;
    //class
    public $obj;
    
    public function rules() {
        return [
            [['category'], 'required', 'message' => 'Необходимо указать  где создан чертеж'],
            //['numberWorksDwg', 'checkNumberWorksDwg', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['numberWorksDwg', 'default', 'value' => ''],
            [['noteDwg', 'nameWorksDwg', 'nameStandardDanieliDwg', 'revisionDanieliDwg'], 'string'],
            [['designerDepartmentDwg', 'nameDepartmentDwg'], 'string'],
            [['sheetDanieliDwg'], 'integer'],
            [['works_dwg_1', 'works_dwg_2', 'works_dwg_3', 'department_draft'], 'file', 'extensions' => ['tif', 'jpg', 'jpeg', 'pdf']],
            ['department_kompas', 'file', 'extensions' => 'cdw'],
        ];
    }

    public function save($obj) 
    {
        $this->obj = $obj;
        switch($this->category) {
            case 'department': return $this->saveDwgDepartment();
            case 'works': return DrawingWorks::saveDwg($this, $obj);
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
        $this->dwg->file = $file->name;
        $this->dwg->note = $this->note;
        return $this->dwg->save();
    }
    
    private function saveDwgDepartment()
    {
        $dwg = new DrawingDepartment(); 
        $dwg->number = DrawingLogic::getNewNumberDepartmentDwg(); 
        $dwg->save(); 

        $dwg->designer = $this->designerDepartmentDwg;
        $dwg->date = time();
        $dwg->name = $this->nameDepartmentDwg;
        $dwg->code = $this->obj->code;
        $dwg->note = $this->noteDwg;
        $this->uploadFileDraft($dwg);
        $this->uploadFileKompas($dwg);
        return $dwg->save();    
    }
    
    private function uploadFileDraft($dwg) 
    {
        $file = UploadedFile::getInstance($this, 'department_draft');
        if ($file) $dwg->file = $this->uploadFile($dwg->id, $file, 'department', '_draft' ); 
    }
     
    private function uploadFileKompas($dwg) 
    {
        $file = UploadedFile::getInstance($this, 'department_kompas');
        if ($file)  $dwg->file_cdw = $this->uploadFile($dwg->id, $file, 'department/kompas', '_kompas' ); 
    }
    
//    public function checkNumberWorksDwg($attribute, $params)
//    {
//        if ($this->category == 'works' && !$this->numberWorksDwg) {
//            $this->addError($attribute, 'Необходимо указать номер чертежа');
//        }  
//    }
    
    
    
    

}

