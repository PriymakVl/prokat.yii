<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingDepartmentOld;
use app\models\InventoryNumber;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        $path = 'files/excel/inventory.xls';
        //$objPHPExcel = new \PHPExcel();
        //$objPHPExcel = PHPExcel_IOFactory::load($path);
        //debug($objPHPExcel);
        $fileType = \PHPExcel_IOFactory::identify($path);  // ������ ��� �����, excel ����� ������� ����� � ������ ��������, xls, xlsx � ������
        $reader = \PHPExcel_IOFactory::createReader($fileType); // ������� ������ ��� ������ �����
        $excel = $reader->load($path); // ��������� ������ ����� � ������
        $array = $excel->getActiveSheet()->toArray(); // ��������� ������ �� ������� � ������
        $this->setData($array);
        exit('end');
        debug($array);
    }
    
    public function setData($data)
    {
        foreach ($data as $item) {
            $obj = new InventoryNumber();
            $obj->name = $item[2];
            $obj->number = $item[1];
            $obj->save();
        }
    }
    

    

    
}