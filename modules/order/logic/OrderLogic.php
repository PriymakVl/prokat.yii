<?php

namespace app\modules\order\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\order\models\Order;
use app\modules\objects\models\Objects;
use app\modules\order\models\OrderContent;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\equipments\models\Equipment;

class OrderLogic extends BaseLogic
{
    
    const CURRENT_PERIOD = 4;
	const UNDEFINED_PERIOD = 1;
    
    const TYPE_ENHANCEMENT = 1; //улучшение
    const TYPE_MAKING = 4; //изготовление
    const TYPE_MAINTENANCE = 5; //текущий ремонт
    const TYPE_CAPITAL_REPAIR = 6; // капитальный ремонт
    

    public static function getParams($period, $customer, $section = null, $equipment = null, $unit = null, $state = null, $type = null)
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        if ($period != 'all') $params['period'] = $period ? $period : self::CURRENT_PERIOD;
        if ($state == Order::STATE_DRAFT) $params['state'] = $state;
        if ($state != 'all') $params['state'] = $state ? $state : Order::STATE_ACTIVE;
        if ($customer && $customer != 'all') $params['customer'] = $customer;
        if ($section) $params['section'] = $section;
        if ($equipment) $params['equipment'] = $equipment;
        if ($unit) $params['unit'] = $unit;
        if ($type) $params['type'] = $type;
        //if (self::in_get('service')) $params['year'] = Yii::$app->request->get('service');
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case self::TYPE_ENHANCEMENT : return 'Улучшение'; break;
            case self::TYPE_MAKING : return 'Изготовление'; break;
            case self::TYPE_MAINTENANCE : return 'Текущий ремонт'; break;
            case self::TYPE_CAPITAL_REPAIR : return 'Капитальный ремонт'; break;
        }
    }
    
    public static function setSessionActiveOrder($order_id)
    {
        $session = Yii::$app->session;
        $session->set('order_id', $order_id);
    }
    
    public static function countWeightOfAll($weight, $count)
    {
        if (!$weight || !$count) return false;
        $weight = str_replace(',', '.', $weight);
        $weightAll = bcmul($weight, (string)$count, 2);
        return str_replace('.', ',', $weightAll);
    }
    
    public static function saveParamsFromObject($object, $order_id, $file)
    {
        $item = new OrderContent();
        $item->order_id = $order_id; 
        $item->obj_id = $object->id;
        $item->name = self::setItemNameFromObject($item, $object);
        $item->code = $object->code;
        $item->weight = $item->weight ? $item->weight : $object->weight;
        $item->item = $item->item ? $item->item : $object->item;
        if ($object->equipment) $item->equipment = $object->equipment;
        $item->count = 1;
        if ($object->material) $item->material = $object->material;
        else if ($object->type == 'unit') $item->material = 'Сб';
        $item->dimensions = $object->dimensions;
        if ($file) $item->file = $file;
        $item->drawing = self::codeWithoutVariant($object->code);
        if ($item->drawing != $item->code) $item->variant = explode('/', $object->code)[1];
        $item = self::setDrawing($object, $item);
        $item->save();
        return $item;
    }
    
    private static function setItemNameFromObject($item, $object) 
    {
        if ($item->name) return $item->name;
        if ($object->order_name) return $object->order_name; 
        else if ($object->alias) return $object->alias;
        else if ($object->rus) return $object->rus; 
        else return $object->eng;    
    }
    
    private static function setDrawing($object, $item)
    {
        $drawings = ObjectLogic::getDrawings($object);
        $number_dwg = DrawingLogic::countOfNumberDrawingsObject($drawings);
        if ($number_dwg != 1) return $item;
        if (count($drawings['department']) == 1) $item = self::setDrawingDepartment($drawings['department'][0], $item);
        else if (count($drawings['danieli']) == 1) $item = self::setDrawingDanieli($drawings['danieli'][0], $item);
        else if (count($drawings['sundbirsta']) == 1) $item = self::setDrawingSundbirsta($drawings['sundbirsta'][0], $item);
        else if (count($drawings['works']) == 1) $item = self::setDrawingWorks($drawings['works'][0], $item);
        else if (count($drawings['standard_danieli']) == 1) $item = self::setDrawingStandardDanieli($drawings['standard_danieli'][0], $item); 
        return $item;    
    }
    
    private static function setDrawingDepartment($dwg, $item)
    {
        $item->cat_dwg = 'department';
        $dwg->getFullNumber();
        $item->drawing = $dwg->fullNumber;
        if (!$item->file) $item->file = $dwg->file;
        return $item;    
    }
    
    private static function setDrawingDanieli($dwg, $item)
    {
        $item->cat_dwg = 'danieli';  
        $item->drawing = $item->getCodeWithoutVariant($dwg->code);
        if (!$item->file) $item->file = $dwg->file; 
        return $item; 
    }
    
    private static function setDrawingSundbirsta($dwg, $item)
    {
        $item->cat_dwg = 'sundbirsta';  
        if ($item->equipment == 'sundbirsta') $item->drawing = $dwg->code;
        if (!$item->file) $item->file = $dwg->file; 
        return $item; 
    }
    
    private static function setDrawingWorks($dwg, $item)
    {
        $item->cat_dwg = 'works';
        $item->drawing = $dwg->number;
        if (!$item->file) {
            $file = $dwg->getFiles(); 
            if (count($file) == 1) $item->file = $file[0]->file;   
        }
        return $item;
    }
    
    private static function setDrawingStandardDanieli($dwg, $item)
    {
        $item->cat_dwg = 'standard_danieli';  
        $item->drawing = $item->getCodeWithoutVariant($dwg->code);
        if (!$item->file) $item->file = $dwg->file;  
        return $item;
    }

    public static function getPathDrawing($item)
    {
        if (!$item->equipment || !$item->file || !$item->cat_dwg) return null;
        if ($item->cat_dwg == 'danieli') return '/files/vendor/danieli/'.$item->file;
        else  if ($item->cat_dwg == 'sundbirsta') return '/files/vendor/sundbirsta'.$item->file; 
        else  if ($item->cat_dwg == 'department') return '/files/department/'.$item->file;
        else if ($item->cat_dwg == 'works') return '/files/works/'.$item->file;
        else if ($item->cat_dwg == 'standard_danieli') return '/files/standard/danieli/'.$item->file;
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
			if ($item->weightAll) {
				$weight_items = str_replace(',', '.', $item->weightAll);
				$weight_order = $weight_order + $weight_items;
			}
        }
		if ($weight_order) return str_replace('.', ',', $weight_order);
		else return $weight_order;
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
		if ($date > 1491253100) return self::CURRENT_PERIOD;
		else if ($date < 1487048400 && $date > 1420434000) return 3; //2015 - 2017
		else if ($date < 1420434000 )return 2;//2010 - 2015
	}
    
    public static function convertPeriod($period)
    {
        switch ($period) {
            case 1: return 'Не известно';
            case 2: return '2011-2015';
            case 3: return '2015-2017';
            case 4: return 'Текущий';
            default: return 'Не известно';
        }   
    }
    //by order_id 
    public static function getArrayOrders($array)
    {
        $orders = [];
        foreach ($array as $item) {
            if ($item->order_id) $order = Order::getOne($item->order_id, null, self::STATUS_ACTIVE);
            if ($order) $orders[] = $order; 
        }
        return $orders;
    }
    
    public static function convertWork($work, $html)
    {
        if (!$work) return false;
        $work = unserialize($work);
        if (!$html || !is_array($work)) return $work;
        else {
            $str = '<ol>';
            foreach ($work as $item) {
                $str .= '<li>'.$item.'</li>';
            }
            return $str .= '</ol>';
        }  
    }
    
    public static function removeZerosFromWeight($weight)
    {
        $letter = substr($weight, -1);
        if ($letter === '0') $weight = substr($weight, 0, -1);
        $letter = substr($weight, -1);
        if ($letter === '0') $weight = substr($weight, 0, -1);
        $letter = substr($weight, -1);
        if ($letter === ',') $weight = substr($weight, 0, -1);
        return $weight;
    }
    
    public static function convertLocation($id)
    {
        if (!$id) return null;
        $item = Equipment::getOne($id, null, self::STATUS_ACTIVE);
        if ($item) return $item->name;
        else return null;
    }
    
    public static function getOrdersByCode($code)
    {
        $order_ids = OrderContent::find()->select('order_id')->where(['code' => $code, 'status' => self::STATUS_ACTIVE])->column();
        
        if ($order_ids) {
            $orders = Order::findAll($order_ids);
            $sql = 'SELECT * FROM '.Order::tableName().' WHERE `id` IN ('.implode(',', $order_ids).') AND state !='.Order::STATE_DRAFT.' AND status='.Order::STATUS_ACTIVE;
            $orders = Order::findBySql($sql)->all();
            if (!$orders) return [];
            $orders = self::executeMethodsOfObjects($orders, ['getNumber', 'convertState']); 
            return array_reverse($orders);  
        }
        return [];    
    }
    
    public static function copyOrder($order_id, $number) 
    {
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $order->id = null;
        $order->number = $number;
        $order->setIsNewRecord(true);
        $order->save(false); 
        self::copyContentOrder($order_id, $order->id);
        return $order->id;
    }
    
    private static function copyContentOrder($old_id, $new_id)
    {
        $content = OrderContent::find()->where(['status' => self::STATUS_ACTIVE, 'order_id' => $old_id])->all();
        //if (!$content) return;
        foreach ($content as $item) {
            $item->id = null;
            $item->order_id = $new_id;
            $item->setIsNewRecord(true);
            $item->save(false);      
        }
    }
    
    public static function getMaterialWithGost($material) 
    {
        switch($material) {
            case 'Ст3': return 'Ст3 ГОСТ 380-94';
            case 'Ст45': return 'Ст45 ГОСТ 1050-88';
            case 'Ст40Х': return 'Ст40Х ГОСТ 4543-71';
            case 'Ст50Г': return 'Ст50Г ГОСТ 4543-71';
            case 'Ст65Г': return 'Ст65Г ГОСТ 14959-79';
            case 'ОЦС 5-5-5': return 'Бронза ОЦС 5-5-5';
            case 'Сб': return 'Сборочный узел';
            default: return $material;
        }
    }
    
    public static function convertDimensions($dimen)
    {
        if (!$dimen) return '';
        $dimen = unserialize($dimen);
        switch($dimen['type']) {
            case 'bush': return 'Ø'.$dimen['out_diam'].'/Ø'.$dimen['in_diam'].'; H='.$dimen['height'].';';
            case 'shaft': return 'Ø'.$dimen['diam'].'; L='.$dimen['length'].';';
            case 'bar': return $dimen['height'].'x'.$dimen['width'].'x'.$dimen['length'].';';
            case 'nut': return self::convertDimensionsNut($dimen);
            case 'bolt': return self::convertDimensionsBolt($dimen);
        }
    }
    
    private static function convertDimensionsBolt($dimen)
    {
        //debug($dimen);
        if (!$dimen['thread']) return '';
        $dimen_str = $dimen['pitch'] ? 'M'.$dimen['thread'].'x'.$dimen['pitch'].';' : 'M'.$dimen['thread'].';';
        $dimen_str =$dimen['class'] ?  substr($dimen_str, 0, -1).'-'.$dimen['class'].';' : $dimen_str; 
        $dimen_str =$dimen['length'] ? $dimen_str.' L='.$dimen['length'].';' : $dimen_str;
        return $dimen_str;      
    }
	
	private static function convertDimensionsNut($dimen)
    {
        if (!$dimen['thread']) return '';
        $dimen_str = $dimen['pitch'] ? 'M'.$dimen['thread'].'x'.$dimen['pitch'].';' : 'M'.$dimen['thread'].';';
        $dimen_str =$dimen['class'] ?  substr($dimen_str, 0, -1).'-'.$dimen['class'].';' : $dimen_str; 
        return $dimen_str;      
    }
    
    public static function getNumberOfFutureOrder()
    {
        $number = self::getNumberFromWhiteList();
        if ($number) return $number;
        $current_period = '1491253200';
        //$sql = "SELECT * FROM `orders` WHERE `date` > ".$current_period." AND `status` = '1' ORDER BY `number` DESC";
        //$orders = \Yii::$app->db->createCommand($sql)->execute();
        $orders = Order::find()->where(['status' => Order::STATUS_ACTIVE])->andWhere(['>', 'date', $current_period])
            ->orderBy(['number' => SORT_DESC])->all();
        if ($orders === false) return 1; //if in database not records;
        if ($orders[0]['number'] == 900) return 1;
        return $orders[0]['number'] + 1;
    }
    
    private static function getNumberFromWhiteList()
    {
        $path = '../web/params/order_numbers.txt';
        $numbers = file($path);
        if (!$numbers) {
            \Yii::$app->session->setFlash('danger', 'Список свободных заказов пуст');
            return false;
        }
        return $numbers[0]; 
    }
    
    public static function deleteNumberFromWhiteList($number)
    {
        $path = '../web/params/order_numbers.txt';
        $numbers = file($path);
        if (!$numbers) return false;
        if (trim($numbers[0]) != $number) return false;
        unset($numbers[0]);
        return file_put_contents($path, implode('', $numbers));    
    }
    
    public static function getIdAciveOrder($message)
    {
        $order_id = self::getActive('order-active');
        if ($order_id) return $order_id;
        \Yii::$app->session->setFlash('error', $message);
        return false;    
    }
    
    public static function deleteOrAddItemContent($ids)
    {
        $content = OrderContent::findAll(explode(',', $ids));
        foreach ($content as $item) {
            if ($item->item) {
                $item->item = '';
                $item->save();
            }
            else {
                if (!$item->obj_id) continue;
                $obj = Objects::getOne($item->obj_id, null, Objects::STATUS_ACTIVE);
                if ($obj) $item->item = $obj->item;
                $item->save();
            }
        }
    }
    
    public static function arrangingContent($content)
    {
        global $contentOrder;
        if (!$content) return [];
        foreach ($content as $item) {
            if ($item->children) {
                $contentOrder[] = $item;
                self::arrangingContent($item->children);
            }
            else $contentOrder[] = $item;
        }
        return $contentOrder;
    }
    
    public static function sortContentById($ids, $content)
    {
        $data = [];
        foreach ($ids as $id) {
            foreach ($content as $item) {
                if ($item->id == $id) $data[] = $item;
            }    
        }
        return $data;    
    }

}





