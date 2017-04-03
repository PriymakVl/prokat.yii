<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\modules\drawing\models\DrawingVendor;
use app\models\DrawingVendorOld;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingObject;
use app\models\Objects;
use app\models\Category;
use app\models\CategoryContent;
use app\models\lists\ListContent;
use app\modules\standard\models\Standard;
use app\modules\standard\models\StandardOld;
use app\modules\standard\models\StandardFile;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        $file = 'files/excel/orders.xls';
        $fileType = \PHPExcel_IOFactory::identify($file);
        $reader = \PHPExcel_IOFactory::createReader($fileType);
        $excel = $reader->load($file);
        $content = $excel->getActiveSheet()->toArray();
        $this->getData($content); 
        exit('end');
    }
    
    private function getData($content)
    {
        for ($i = 2; $i < 2202; $i++)
        {
            $this->saveItem($content[$i]);
        }
    }
    
    private function saveItem($row)
    {
        $order_id = $this->saveOrder($row[6]);
        //$item = OrderContent::findOne(['name' => $row[1], 'order_id' => $order_id]);
        $item = new OrderContent();
        $item->name = $row[1] ? $row[1] : 'item';
        $item->drawing = $row[8] ? $row[8] : 'drawing';
        $item->material = $row[10] ? $row[10] : '';
        $item->order_id = $order_id;
        $item->save();    
    }
    
    private function saveOrder($str)
    {
        $number = substr($str, -3);
        $order = Order::findOne(['number' => $number]);
        if ($order) return $order->id;
        $order = new Order();
        $order->name = 'заказ';
        $order->number = $number;
        $order->save();
        return $order->id;    
    }

    
    
}