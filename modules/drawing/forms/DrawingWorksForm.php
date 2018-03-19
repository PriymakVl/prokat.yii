<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingWorksForm extends BaseForm
{
    public $designer;
    public $department;
    public $code;
    public $number;
    public $name;
    public $sheet_1, $sheet_2, $sheet_3;
    public $parent_id;
    //form
    public $dwg;

    
    public function __construct($dwg)
    {
        if ($dwg) $this->dwg = $dwg;
        else $this->dwg = new DrawingWorks; 
    }

    public function rules() 
    {
        return [
            [['name', 'designer', 'department', 'note', 'number', 'code'], 'string'],
            [['sheet_1', 'sheet_2', 'sheet_3'], 'file', 'extensions' => ['tif', 'jpg', 'jpeg', 'pdf']],
            ['parent_id', 'integer'],
            ['parent_id', 'default', 'value' => 0]
        ];

    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    public function save()
    {
        $this->dwg->code = $this->code;
        $this->dwg->parent_id = $this->parent_id;
        $this->dwg->note = $this->note;
        if (!$this->dwg->date) $this->dwg->date = time();
        $this->dwg->number = $this->number;
        $this->dwg->name = $this->name;
        $this->dwg->save();
        $sheet_1 = $this->uploadFileWorks(1);
        $sheet_2 = $this->uploadFileWorks(2);
        $sheet_3 = $this->uploadFileWorks(3);
        if ($sheet_1) $this->dwg->sheet_1 = $sheet_1;
        if ($sheet_2) $this->dwg->sheet_2 = $sheet_2;
        if ($sheet_3) $this->dwg->sheet_3 = $sheet_3;
        return $this->dwg->save();
    }

    private function uploadFileWorks($number)
    {
        $file = UploadedFile::getInstance($this, 'sheet_'.$number);
        if (!$file) return null;
        $filename = $this->dwg->id.'_works_'.$number.'.'.$file->extension;
        $file->saveAs('files/works/'.$filename);
        return $filename;
    }



}

