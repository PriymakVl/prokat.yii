<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingWorksFile;

class DrawingWorksFileForm extends BaseForm
{   
    public $file;
    public $sheet;
    public $note;
    public $dwg_id;
    //form
    public $file_id;

    
    public function rules() 
    {
        return [
            ['sheet', 'default', 'value' => 1],
            ['dwg_id', 'default', 'value' => 0],
            ['note', 'default', 'value' => ''],
            ['file', 'file', 'extensions' => ['pdf', 'tif']],
        ];

    }


    public function save($file) 
    {
        if (!$file) $file = new DrawingWorksFile();
        $file = $this->updateData($file);
        if ($file->save()) {
            $this->file_id = $file->id;
            $file->file = $this->uploadFileWorks($file);
            if ($file->file) return ($file->save());    
        }
        else return false;
        
    }
    
    private function uploadFileWorks($file)
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        return $this->uploadFile($file->id, $this->file, 'works', '_works');    
    }
    
    private function updateData($file)
    {
        $file->sheet = $this->sheet;
        $file->note = $this->note;
        $file->dwg_id = $this->dwg_id;
        return $file;
    }



}

