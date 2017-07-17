<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\applications\models\Application;
use app\modules\applications\models\ApplicationProduct;
use app\modules\applications\models\ApplicationContent;

class AppexcelController extends BaseController {
    
    public function actionIndex()
    {
        $path = 'files/excel/om_1.xls';
        //$objPHPExcel = new \PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load($path);
        //debug($objPHPExcel);
        $fileType = \PHPExcel_IOFactory::identify($path);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
        $reader = \PHPExcel_IOFactory::createReader($fileType); // создаем объект для чтения файла
        $excel = $reader->load($path); // загружаем данные файла в объект
        $array = $excel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
        //debug($array);
        $this->save($array);
        exit('end');
    }
    
    public function save($data) 
    {
        for ($i = 0; $i < count($data); $i++) {
            $app_id = $this->addApp($data[$i]);
            if ($app_id === false) continue;
            $product_id = $this->addProduct($data[$i]);
            $this->addAppContent($app_id, $product_id, $data[$i]);
        }    
    }
    
    private function addApp($row)
    {
        //debug($row[1]);
        $out_num = trim(explode('-', $row[0])[1]);
        if (!(int)$out_num) return false;
        $app = Application::findOne(['out_num' => $out_num, 'year' => '2017', 'status' => 1]);
        if ($app) return $app->id;
        $app = new Application();
        $app->out_num = $out_num;
        //date out
        $out_date = preg_match('/[0-9]{1,2}(\\/|.)[0-9]{2}(\\/|.)[0-9]{2,4}/', trim($row[1]), $matches);
        $out_date = $matches[0];
        $app->out_date = $out_date ? strtotime($out_date) : '';
        
        $app->ens = (int)trim(explode('/', $row[2])[1]) ? (int)trim(explode('/', $row[2])[1]) : 0;
        $app->date = time();
        $app->service = 'mech';
        $app->year = '2017';
        $app->period = 'year';
        $app->state = '2';
        $app->title = 'Заявка';
        $app->department = 'supply';
        $app->executor = $row[23] ? $row[23] : '';
        return $app->save() ? $app->id : false;   
    }
    
    private function addProduct($row)
    {
        if ($row[4]) $product = ApplicationProduct::find()->where(['code' => $row[4], 'status' => self::STATUS_ACTIVE])->one();
        else if (!$row[4]) $product = ApplicationProduct::find()->where(['name' => $row[3], 'status' => self::STATUS_ACTIVE])->one();
        if (!$product) {
            $product = new ApplicationProduct();
            $product->name = $row[3];
            $product->units = $row[5];   
        }
        if (!$product->executor) $product->executor = $row[23];
        if (!$product->code && $row[4]) $product->code = $row[4];
        $product->department = 'supply';
        if (!$product->date) $product->date = time();
        $product->save();
        return $product->id; 
    }
    
    private function addAppContent($app_id, $product_id, $row)
    {
        $content = new ApplicationContent();
        $content = ApplicationContent::findOne(['app_id' => $app_id, 'product_id' => $product_id, 'status' => self::STATUS_ACTIVE]);
        if (!$content) $content = new ApplicationContent();
        $content->need = $row[6];
        $content->price = $row[7];
        $content->currency = 'грн';
        if (!$content->app_id) $content->app_id = $app_id;
        if (!$content->product_id) $content->product_id = $product_id;
        return $content->save();
    }
    
    

}

















