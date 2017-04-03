<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;

class ExcelController extends BaseController {
    
    public function actionRead()
    {
        $path = 'files/excel/test.xls';
        //$objPHPExcel = new \PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load($path);
        //debug($objPHPExcel);
        $fileType = \PHPExcel_IOFactory::identify($path);  // ������ ��� �����, excel ����� ������� ����� � ������ ��������, xls, xlsx � ������
        $reader = \PHPExcel_IOFactory::createReader($fileType); // ������� ������ ��� ������ �����
        $excel = $reader->load($path); // ��������� ������ ����� � ������
        $array = $excel->getActiveSheet()->toArray(); // ��������� ������ �� ������� � ������
        debug($array);
    }
    
    public function getDataWithKeys() 
    {
        //add keys in array
        $arr = array();
        
        for ($i = 0, $count = count($this->arr); $i < $count; $i++) {
            if($i == 0) continue;
            for ($j = 0; $j < count($this->arr[$i]); $j++) {
                $arr[$i][$this->arr[0][$j]] = $this->arr[$i][$j];  
            }
        }
        return $arr;    
    } 
    
    

}

















