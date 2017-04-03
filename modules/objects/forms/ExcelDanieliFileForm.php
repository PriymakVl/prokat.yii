<?php

namespace app\modules\objects\forms;

use yii\web\ForbiddenHttpException;
use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\objects\models\Objects;

class ExcelDanieliFileForm extends BaseForm
{   
    public $file;
    
    public function rules() 
    {
        return [
            ['file', 'file', 'extensions' => ['xls']],
        ];

    }


    public function save($parent) 
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        if (!$this->file) return false;
        $data = $this->getDataFromFileExcel();
        if ($data[1][2] != $parent->code) throw new ForbiddenHttpException('error diffrent parent '.__METHOD__);//choose file for another parent
        return $this->addObjectsToParent($data, $parent);  
    }
    
    private function getDataFromFileExcel()
    {
        $fileType = \PHPExcel_IOFactory::identify($this->file->tempName);
        $reader = \PHPExcel_IOFactory::createReader($fileType);
        $excel = $reader->load($this->file->tempName);
        return $excel->getActiveSheet()->toArray();
    }
    
    private function addObjectsToParent($data, $parent) {
        $children = Objects::find()->select('code')->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent->id])->column();
        for ($i =1, $count = count($data); $i < $count; $i++) {
            if (!empty($children)) {
                if(in_array($data[$i][3], $children)) continue;    
            }
            $obj = Objects::findOne(['status' => self::STATUS_ACTIVE, 'code' => $data[$i][3]]);
            if (!$obj) continue;
            $obj->copy($parent->id);
            $objNew = Objects::findOne($obj->id);
            $objNew->item = $data[$i][4]; //change item old 
            $objNew->save();
        }
        return true;
    }



}

