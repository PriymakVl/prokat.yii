<?php

namespace app\modules\objects\controllers;

use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ExcelDanieliFileForm;


class ObjectDanieliUpdateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex() 
    {        
        $dir = 'files/excel';
        $folders = scandir($dir);
        for ($i = 2, $count = count($folders); $i < $count; $i++) {
            $path = $dir.'/'.$folders[$i];
            $list = scandir($path);
            $this->addObjectFromFile($list, $path);
        }
        die('success');
    }
    
    public function addObjectFromFile($list, $path)
    {
        for ($i = 2, $count = count($list); $i < $count; $i++)
        {
            $file = $path.'/'.$list[$i];
            $data = $this->getDataFromFileExcel($file);
            $this->addObjectsToParent($data, $parent);        
        }
    }
    
    private function getDataFromFileExcel($file)
    {
        $fileType = \PHPExcel_IOFactory::identify($file);
        $reader = \PHPExcel_IOFactory::createReader($fileType);
        $excel = $reader->load($file);
        return $excel->getActiveSheet()->toArray();
    }
    
    private function addObjectsToParent($data) {
        $parents = $this->getParentArray($data[1][2]);
        foreach ($parents as $parent)
        {
            $this->addChildrenParent($data, $parent);  
        }
    }
    
    private function getParentArray($parent_code)
    {
        return Objects::findAll(['status' => self::STATUS_ACTIVE, 'code' => $parent_code]);    
    }
    
    private function addChildrenParent($data, $parent)
    {
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