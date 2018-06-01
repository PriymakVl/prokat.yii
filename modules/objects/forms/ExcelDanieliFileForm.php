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
        if ($data[1][2] != $parent->code) throw new ForbiddenHttpException('ролитель в файле и у объекта отличаютмя');//choose file for another parent
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
            if (!$obj) {
				$this->createNewObject($data[$i], $parent->id);
				continue;
			}
            $obj->copy($parent->id);
            $objNew = Objects::findOne($obj->id);
            $objNew->item = $data[$i][4]; //change item old 
            $objNew->save();
        }
        return true;
    }
	
	private function createNewObject($data, $parent_id)
	{
		$obj = new Objects();
		$obj->code = trim($data[3]); 
        $obj->parent_id = $parent_id;
        $obj->eng = trim($data[20]);
		//$obj->weight = $this->weight;
		//$obj->qty = $this->qty;
        $obj->equipment = 'danieli';
        $obj->item = trim($data[4]);
        return $obj->save();            
	}



}

