<?php

namespace app\modules\order\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;

class OrderLogic extends BaseLogic
{
    
    const CURRENT_PERIOD = 4;
	const UNDEFINED_PERIOD = 1;

    public static function getParams($period, $customer, $tag)
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        if ($period != 'all') $params['period'] = $period ? $period : self::CURRENT_PERIOD;
        if ($customer && $customer != 'all') $params['customer'] = $customer;
        if ($tag && $tag != 'all') $params['tag'] = $tag;
        //if (self::in_get('year')) $params['year'] = Yii::$app->request->get('year', date('Y'));
        if (self::in_get('service')) $params['year'] = Yii::$app->request->get('service');
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case '1' : return 'улучшение'; break;
            case '4' : return 'изготовление'; break;
            case '5' : return 'услуга'; break;
            case '6' : return 'капитальный ремонт'; break;
        }
    }
    
    public static function setSessionActiveOrder($order_id)
    {
        $session = Yii::$app->session;
        $session->set('order_id', $order_id);
    }
    
    public static function checkState($order_id)
    {
        $session = Yii::$app->session;
        $active_id = $session->get('order_id');
        if ($active_id == $order_id) return 'active';
        else return false;    
    }
    
    public static function countWeightOfAll($weight, $count)
    {
        if (!$weight || !$count) return false;
        $weight = str_replace(',', '.', $weight);
        $weightAll = bcmul($weight, (string)$count, 2);
        return str_replace('.', ',', $weightAll);
    }
    
    public static function saveParamsFromObject($object, $order_id = null)
    {
        if (!$order_id) $order_id = self::getActiveOrderId();
        $content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $order_id]);
        if ($content)  {
            $item = self::checkItemByCode($content, $object->code);
            if (!$item) $item = new OrderContent();
            $item = OrderLogic::setParamsFromObject($item, $object, $order_id);
        }
        else {
            $item = new OrderContent();
            $item = OrderLogic::setParamsFromObject($item, $object, $order_id);
        }
        //debug($item);
        $item->save();
        return $item;
    }
    
    public static function setParamsFromObject($item, $object, $order_id)
    {
        $item->order_id = $order_id; 
        $item->obj_id = $object->id;
        $item->name = self::setItemNameFromObject($item, $object);
        $item->code = $object->code;
        $item->weight = $item->weight ? $item->weight : $object->weight;
        $item->item = $item->item ? $item->item : $object->item;
        $item->equipment = $object->equipment;
        return self::setDrawingFromObject($item, $object);
    }
    
    private static function setItemNameFromObject($item, $object) 
    {
        if ($item->name) return $item->name;
        if ($object->alias) return $object->alias;
        else if ($object->rus) return $object->rus; 
        else return $object->eng;    
    }
    
    private static function setDrawingFromObject($item, $object)
    {
        $drawings = ObjectLogic::getDrawings($object);
        $number_dwg = DrawingLogic::countOfNumberDrawingsObject($drawings);
        if ($number_dwg != 1) return $item;
        if (count($drawings['department']) == 1) $item = self::setDrawingDepartment($drawings['department'][0], $item);
        else if (count($drawings['vendor']) == 1) $item = self::setDrawingVendor($drawings['vendor'][0], $item);
        else if (count($drawings['works']) == 1) $item = self::setDrawingWorks($drawings['works'][0], $item);
        else if (count($drawings['standard']) == 1) $item = self::setDrawingStandard($drawings['standard'][0], $item); 
        return $item;    
    }
    
    private static function setDrawingDepartment($dwg, $item)
    {
        $item->cat_dwg = 'department';
        $dwg->getNumber();
        $item->drawing = $dwg->number;
        $item->file = $dwg->file;
        return $item;    
    }
    
    private static function setDrawingVendor($dwg, $item)
    {
        $item->cat_dwg = 'vendor';  
        if ($item->equipment == 'danieli') $item->drawing = $item->getCodeWithoutVariant($dwg->code);
        $item->file = $dwg->file; 
        return $item; 
    }
    
    private static function setDrawingWorks($dwg, $item)
    {
        $item->cat_dwg = 'works';
        $item->drawing = $dwg->number;
        $file = $dwg->getFiles();
        if (count($file) == 1) $item->file = $file[0]->file;
        return $item;
    }
    
    private static function setDrawingStandard($dwg, $item)
    {
        $item->cat_dwg = 'standard';  
        if ($item->equipment == 'danieli') $item->drawing = $item->code;
        $item->file = $dwg->file;  
        return $item;
    }
    
    public static function getActiveOrderId()
    {
        $session = Yii::$app->session;
        $order_id = $session->get('order_id');
        if (!$order_id) throw new ForbiddenHttpException('error active order '. __METHOD__);
        return $order_id;    
    }
    
    public static function getPathDrawing($item)
    {
        if (!$item->equipment || !$item->file || !$item->cat_dwg) return null;
        if ($item->cat_dwg == 'vendor') return '/files/vendor/'.$item->equipment.'/'.$item->file; 
        else  if ($item->cat_dwg == 'department') return '/files/department/'.$item->file;
        else if ($item->cat_dwg == 'works') return '/files/works/'.$item->file;
        else if ($item->cat_dwg == 'standard') return '/files/standard/'.$item->equipment.'/'.$item->file;
        else return null;
    }
    
    public static function addFileOfItemOrder($file, $cat_dwg, $object)
    {
        $order_id = self::getActiveOrderId();
        $content = OrderContent::findAll(['order_id' => $order_id, 'status' => self::STATUS_ACTIVE]);
        if (!$content) return false;
        else $item = self::getItemOrderByCode($content, $object->code);
        if (!$item) return false;
        $item->file = $file;
        $item->cat_dwg = $cat_dwg;
        $item->equipment = $object->equipment;
        if ($item->save()) return $item->id;
        else return false;
    }
    
    private static function getItemOrderByCode($content, $code)
    {
        foreach ($content as $item) {
            if ($item->code == $code) return $item;
        }
        return false;
    }
    
    public static function countWeightOfOrder($order_id)
    {
        $weight_order = 0;
        $content = OrderContent::findAll(['order_id' => $order_id, 'status' => self::STATUS_ACTIVE]);
        foreach ($content as $item) {
            $item->countWeightAll();
            if ($item->weightAll) $weight_order += $item->weightAll;
        }
        return $weight_order;
    }
    
    public static function checkItemByCode($items, $code)
    {
        foreach ($items as $item) {
            if ($item->drawing == $code) return $item;
        }
    }
	
	public static function getPeriod($date)
	{
		if (!$date) return self::UNDEFINED_PERIOD;
		if ($date > 1487048400) return self::CURRENT_PERIOD;
		else if ($date < 1487048400 && $date > 1420434000) return 3; //2015 - 2017
		else if ($date < 1420434000 )return 2; return 2; //2010 - 2015
	}
    //by order_id 
    public static function getArrayOrders($array)
    {
        $orders = [];
        foreach ($array as $item) {
            if ($item->order_id) $order = Order::getOne($item->order_id, null);
            if ($order) $orders[] = $order; 
        }
        return $orders;
    }

}





