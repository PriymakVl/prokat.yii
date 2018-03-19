<?php

namespace app\modules\order\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\order\logic\OrderLogic;
use app\modules\objects\models\Objects;

class OrderContent extends BaseModel
{
    
    const MAIN_PARENT = 0;
    
    public $weightAll;
    public $pathDrawing;
    public $children;
    
    public static function tableName()
    {
        return 'orders_content';
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    public static function getItemsOfOrder($order_id)
    {
        $content = self::find()->where(['status' => self::STATUS_ACTIVE, 'order_id' => $order_id, 'parent_id' => self::MAIN_PARENT])
                    ->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        $content = self::executeMethods($content, ['countWeightAll', 'getWeight', 'getPathDrawing', 'getChildren', ['getDimensions', ['dimensions']]]);
        return OrderLogic::arrangingContent($content);
    }
    
    public static function getContentForPrint($ids)
    {
        $ids = explode(',', $ids);
        $content = self::findAll($ids);
        if (!$content) return false;
        $content = OrderLogic::sortContentById($ids, $content);
        return self::executeMethods($content, ['countWeightAll', 'getWeight', 'getPathDrawing', 'getChildren', ['getDimensions', ['dimensions']]]);
    }
    
    public function countWeightAll()
    {
        $weight_all = OrderLogic::countWeightOfAll($this->weight, $this->count);
        $this->weightAll = OrderLogic::removeZerosFromWeight($weight_all);
        return $this;
    }
    
    public function copyItem($order_id)
    {
        $this->id = null;
        $this->order_id = $order_id;
        $this->setIsNewRecord(true);
        if (!$this->save(false)) throw new ForbiddenHttpException('error '.__METHOD__); 
    }
    
    public function getPathDrawing()
    {
        $this->pathDrawing = OrderLogic::getPathDrawing($this);
        return $this;
    }
    
    public function getChildren()
    {
        $children = self::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        $this->children = self::executeMethods($children, ['countWeightAll', 'getPathDrawing', 'getChildren', ['getDimensions', ['dimensions']]]);
        return $this;
    }

     //public static function searchByCode($code)
//    {
//        $result = self::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', 'code', $code])->all();
//        if (empty($result)) return [];
//        if (count($result) == 1) $orders = Order::findAll(['id' => $result[0]->order_id]);
//        else $orders = OrderLogic::getArrayOrders($result);
//        self::executeMethods($orders, ['getNumber']);
//        return $orders;
//    }
    
    public function getWeight()
    {
        if ($this->weight) $this->weight = OrderLogic::removeZerosFromWeight($this->weight);
        return $this;
    }
	
	public static function checkOrderByCode($code) 
	{
		return self::find()->where(['code' => $code])->one();
	}
    
    public function getDrawing()
    {
        if ($this->sheet > 1) $this->drawing = $this->drawing.' - лист '.$this->sheet;
        return $this;
    }
    
    public function getMaterialWithGost()
    {
        if ($this->material) $this->material = OrderLogic::getMaterialWithGost($this->material);
        if ($this->material_add) $this->material_add = OrderLogic::getMaterialWithGost($this->material_add);
        return $this;
    }
    
    public function getDimensions()
    {
        if ($this->dimensions) $this->dimensions = OrderLogic::convertDimensions($this->dimensions);
        return $this;
    }
    
    public function getCodeObject()
    {
        if (!$this->code && $this->obj_id) {
            $object = Objects::getOne($this->obj_id, false, self::STATUS_ACTIVE);
            $this->code = $object->code;     
        }
        return $this;
    }

    //for show result search orders by code or drawing
    public function getSearchItem($code, $drawing)
    {
        $pos_code = stripos($this->code, $code);
        $pos_dwg = stripos($this->drawing, $drawing);
        if ($pos_code === false && $pos_dwg === false) return false;
        else return ['code' => $this->code, 'drawing' => $this->drawing];
    }
     
}





