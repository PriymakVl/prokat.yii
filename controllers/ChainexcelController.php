<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\chain\models\ChainIso;

class ChainexcelController extends BaseController {
    
    public function actionIndex()
    {
        $path = 'files/excel/chain_1_b.xls';
        //$objPHPExcel = new \PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load($path);
        //debug($objPHPExcel);
        $fileType = \PHPExcel_IOFactory::identify($path);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
        $reader = \PHPExcel_IOFactory::createReader($fileType); // создаем объект для чтения файла
        $excel = $reader->load($path); // загружаем данные файла в объект
        $array = $excel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
//        debug($array);
        $this->save($array);
        exit('end');
    }
    
    public function save($data) 
    {
        for ($i = 0; $i < count($data); $i++) {
            $iso = new ChainIso();
            $iso->name = explode(' ', $data[$i][0])[1];
            $iso->type = 'single';
            $iso->step = $data[$i][1];
            $iso->d1 = $data[$i][1];
            $iso->b1 = $data[$i][2];
            $iso->d2 = $data[$i][3];
            $iso->l = $data[$i][4];
            $iso->lc = $data[$i][5];
            $iso->h2 = $data[$i][6];
            $iso->t = $data[$i][7];
            $iso->q = $data[$i][8];
            $iso->weight = $data[$i][9];
            $iso->save();
        }
    }
    

    

}

















