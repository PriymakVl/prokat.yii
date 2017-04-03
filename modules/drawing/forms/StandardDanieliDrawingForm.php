<?php

namespace app\modules\drawing\models\forms;

use app\models\forms\ModelForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingStandardDanieli;

class StandardDanieliDrawingForm extends ModelForm
{   
    public $name;
    public $note;
    public $pdf;
    public $txt;

    
    public function rules() 
    {
        return [
            ['name', 'default', 'value' => ''],
            ['note', 'default', 'value' => ''],
            ['pdf', 'file', 'extensions' => ['pdf']],
            ['txt', 'file', 'extensions' => ['txt']],
        ];

    }


    public function save() 
    {
        $this->pdf = UploadedFile::getInstance($this, 'pdf');
        $this->txt = UploadedFile::getInstance($this, 'txt');
        $codes = $this->selectCodesFromFile();
        if (empty($codes)) return false;
        $file_name = $this->uploadFileStandardDanieli();
        $this->saveCodesWithFileName($codes, $file_name);
        return true;  
    }
    
    private function uploadFileStandardDanieli()
    { 
        $file_name = rand(1, 10000).'_st_dan.'.$this->pdf->extension;
        if (file_exists('files/standard/danieli/'.$file_name)) {
            return $this->uploadFileStandardDanieli();    
        }
        $this->pdf->saveAs('files/standard/danieli/'.$file_name);    
        return $file_name;  
    }
    
    private function selectCodesFromFile()
    {
        $content = file_get_contents($this->txt->tempName);
        preg_match_all('/0.[0-9]{6}.[A-Z]{1}/', $content, $codes, PREG_PATTERN_ORDER);
        return $codes[0];  
    }
    
    private function saveCodesWithFileName($codes, $fileName)
    {
        foreach ($codes as $code)
        {
            $dwg = DrawingStandardDanieli::findOne(['code' => $code]);
            if (!$dwg) $dwg = new DrawingStandardDanieli();
            $dwg->code = $code;
            $dwg->equipment = 'danieli';
            if (!$dwg->file) $dwg->file = $fileName;
            if (!$dwg->name) $dwg->name = $this->name;
            if (!$dwg->note) $dwg->note = $this->note;
            $dwg->save();
        }
    }



}

