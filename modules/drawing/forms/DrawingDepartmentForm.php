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

    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            ['name', 'required', 'message' => 'Необходимо заполнить поле'],
            [['designer', 'note', 'code'], 'string'],
            ['draft', 'file', 'extensions' => ['pdf', 'tif', 'jpg', 'jpeg']],
            ['kompas', 'file', 'extensions' => ['cdw']],
        ];

    }


    public function save($dwg)
    {
        if (!$dwg) {
            $this->dwg = new DrawingDepartment();
            $this->dwg->number = DrawingLogic::getNewNumberDepartmentDwg();
            //debug($this->dwg->number);
            $this->dwg->year = date('Y');
            $this->dwg->save();
        }
        else $this->dwg = $dwg;
        $this->dwg->designer = $this->designer;
        $this->dwg->date = time();
        $this->dwg->name = $this->name;
        $this->dwg->code = $this->code;
        $this->dwg->note = $this->note;
        $this->uploadFileDraft();
        $this->uploadFileKompas();
        return $this->dwg->save();
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
     

}

