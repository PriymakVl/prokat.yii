<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingStandardDanieli;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingDepartmentOld;
use app\modules\drawing\models\DrawingDanieli;
use app\models\InventoryNumber;
use app\modules\orderact\models\OrderActContent;
use app\modules\order\models\OrderContent;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
       $content = OrderActContent::findAll(['status' => 1]);
       foreach ($content as $item) {
            if (!$item->item_id) continue;
            $obj = OrderContent::findOne($item->item_id);
            $item->name = $obj->name;
            $item->code = $obj->code;
            $item->drawing = $obj->drawing;
            $item->save();
       }
      exit('end');  
    }
    
//    public function setData($data)
//    {
//        foreach ($data as $item) {
//            $obj = new InventoryNumber();
//            $obj->name = $item[2];
//            $obj->number = $item[1];
//            $obj->save();
//        }
//    }
    

    

    
}