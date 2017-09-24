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
use app\modules\drawing\models\DrawingDanieli;
use app\models\InventoryNumber;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        $data = DrawingDanieli::getAll();
        $f = fopen('files/drawings.txt', 'a');
        foreach ($data as $obj) {
            $str = $obj->code.'-'.$obj->file.PHP_EOL;
            fwrite($f, $str);
            //file_put_contents('files/drawings.txt', $str, FILE_APPEND);
        }
        fclose($f);
        exit('end');
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