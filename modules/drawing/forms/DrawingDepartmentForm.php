<?php

namespace app\modules\drawing\forms;

use Yii;
use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartmentForm extends DrawingForm
{   
    public $designer;
    public $code;
    public $number;
    public $date;
    public $status;
    public $note;
    public $draft;
    public $kompas;
    public $name;
    
    public $dwg;
    public $dwg_id;
    public $newNumber;

    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    public function rules() 
    {
        return [
            [['name', 'number'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['designer', 'note', 'code', 'number'], 'string'],
            ['draft', 'file', 'extensions' => ['pdf', 'tif', 'jpg', 'jpeg']],
            ['kompas', 'file', 'extensions' => ['cdw']],
        ];

    }


    public function save($dwg)
    {
        $this->dwg = $this->getDwg($dwg);
        $this->dwg->number = $this->number;
        $this->dwg->year = date('Y');
        $this->dwg->designer = $this->designer;
        $this->dwg->date = time();
        $this->dwg->name = $this->name;
        $this->dwg->code = $this->code;
        $this->dwg->note = $this->note;
        $this->uploadFileDraft();
        $this->uploadFileKompas();
        return $this->dwg->save();
    }

    private function getDwg($dwg)
    {
        if ($dwg) return $dwg;
        $dwg = new DrawingDepartment();
        $dwg->save();
        return $dwg;
    }

    private function uploadFileDraft() 
    {
        if (!$this->dwg->id) return false;
        $file = UploadedFile::getInstance($this, 'draft');
        if ($file) $this->dwg->file = $this->uploadFile($this->dwg->id, $file, 'department', '_draft' ); 
    }
     
    private function uploadFileKompas() 
    {
        if (!$this->dwg->id) return false;
        $file = UploadedFile::getInstance($this, 'kompas');
        if ($file)  $this->dwg->file_cdw = $this->uploadFile($this->dwg->id, $file, 'department/kompas', '_kompas' ); 
    }

    public function getNewNumber()
    {
        $this->newNumber =  DrawingLogic::getNewNumberDepartmentDwg();
        return $this;
    }


}

