<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;

class SunController extends BaseController {
    
    public function actionIndex()
    {
        $path = 'files/excel/sundbirsta/80025471-04_1.xls';
        //$objPHPExcel = new \PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load($path);
        //debug($objPHPExcel);
        $fileType = \PHPExcel_IOFactory::identify($path);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
        $reader = \PHPExcel_IOFactory::createReader($fileType); // создаем объект для чтения файла
        $excel = $reader->load($path); // загружаем данные файла в объект
        $array = $excel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
		$this->clearArray($array);
        exit('end');
    }
	
	private function clearArray($array) {
		foreach ($array as $row) {
			$this->getData($row);
		}
	}
    
    public function getData($array) 
    {
        foreach ($array as $row) {
            $code = $this->getCode($row);
            if (!$code) continue;
            $obj = Objects::findOne(['code' => $code]);
            if ($obj) continue;
            $obj = new Objects();
            $obj->code = $code;
            //$obj->parent_id = 
            $obj->equipment = 'sundbirsta';
			$obj->item = $this->getItem($row);
			$obj->qty = $this->getQty($row);
            $obj->weight = $this->getWeight($row);
			$obj->rus = $this->getName($row, $weight);
            
            $obj->save();
		} 
    } 
	
	private function getItem($row) {
			preg_match('/\\d{3}/', $row, $matches);
			$item = $matches[0];
			preg_match('/[1-9][0-9]?/', $item, $matches);
			return $matches[0];
	}
	
	private function getQty($row) {
		preg_match('/\\s[1-9][0-9]?[0-9]?\\s{0,3}(шт|м)\\s/', $row, $match);
        $qty = $match[0];
        preg_match('/\\d{1,2}/', $qty, $match);
		return $match[0];
	}
	
	private function getName($row, $weight) {
	   preg_match('/(?<=шт|м).+(?='.$weight.')/', $row, $match);
       return trim($match[0]);	//
	}

	private function getWeight($row) {
		preg_match('/[0-9]{1,5}.\\d{1,2}\\s?$/', $row, $matches);
		return $matches[0];
	}
    
    private function getCode($row) {
        preg_match('/([0-9]{1,2}-)?[0-9]{4,8}(-[0-9]{1,2})?/', $row, $matches);
        return $matches[0];
    }
    
    

}

















