<?php

namespace app\modules\order\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\order\logic\OrderLogic;

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
    
    public static function getMainItem($order_id)
    {
        $content = OrderContent::find()->where(['status' => self::STATUS_ACTIVE, 'order_id' => $order_id, 
                'parent_id' => self::MAIN_PARENT])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        $content = self::executeMethods($content, ['countWeightAll', 'getPathDrawing', 'getChildren']);
        return $content;
    }
    
    public function countWeightAll()
    {
        $this->weightAll = OrderLogic::countWeightOfAll($this->weight, $this->count);
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
        $children = self::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
        $this->children = self::executeMethods($children, ['countWeightAll', 'getPathDrawing']);
        return $this;
    }
    
    public static function searchByDrawing($dwg)
    {
        $result = self::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', 'drawing', $dwg])->all();
        if (empty($result)) return [];
        if (count($result) == 1) $orders = Order::findAll(['id' => $result[0]->order_id]);
        else $orders = OrderLogic::getArrayOrders($result);
        self::executeMethods($orders, ['getNumber']);
        return $orders;
    }
    
}





