<?php

namespace app\modules\drawing\models\forms;

use app\models\forms\ModelForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingStandard;

class StandardDrawingForm extends ModelForm
{   
    public $name;
    public $type;
    public $note;
    public $file;
    public $parent_id;
    //form
    public $dwg_id;

    
    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название стандарта'],
            ['type', 'default', 'value' => 'file'],
            ['parent_id', 'default', 'value' => 0],
            ['note', 'default', 'value' => ''],
            ['file', 'file', 'extensions' => ['pdf', 'tif']],
        ];

    }


    public function save($dwg) 
    {
        if (!$dwg) $dwg = new DrawingDepartment();
        $dwg = $this->updateData($dwg);
        if (!$dwg->save()) return false;
        $this->dwg_id = $dwg->id;
        $this->file = UploadedFile::getInstance($this, 'file');
        $dwg->file = $this->uploadFile($dwg->id, $this->file, 'department', '_depart');
        if ($dwg->file) $dwg->update();
        return true;  
    }
    
    private function updateData($dwg)
    {
        $dwg->type = $this->type;
        $dwg->name = $this->name;
        $dwg->designer = $this->designer;
        $dwg->parent_id = $this->parent_id;
        $dwg->note = $this->note;
        $dwg->service = $this->service;
        $dwg->date = time();
        $dwg->year = date('Y', time());
        return $dwg;
    }



}

