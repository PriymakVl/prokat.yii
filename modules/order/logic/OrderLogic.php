<?php

namespace app\modules\order\logic;

use Yii;
use app\logic\BaseLogic;
use yii\web\ForbiddenHttpException;
use app\modules\order\models\OrderContent;

class OrderLogic extends BaseLogic
{

    
    public static function getParams()
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        //if (self::in_get('year')) $params['year'] = Yii::$app->request->get('year', date('Y'));
        if (self::in_get('service')) $params['year'] = Yii::$app->request->get('service');
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case '1' : return 'улучшение'; break;
            case '4' : return 'текущий ремонт'; break;
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
    
    public static function setParamsFromObject($item, $object, $order_id)
    {
        $item->order_id = $order_id; 
        $item->obj_id = $object->id;
        if ($object->alias)$item->name = $object->alias;
        else if ($object->rus) $item->name = $object->rus; 
        else $item->name = $object->eng;
        $item->code = $object->code;
        $item->weight = $object->weight;
        $item->item = $object->item;
        $item->equipment = $object->equipment;
        if ($object->equipment == 'danieli') $item->drawing = $item->getCodeWithoutVariant($object->code);
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

}





