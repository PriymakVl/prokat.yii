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
    
    public static function tableName()
    {
        return 'orders_content';
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    public static function getMain($order_id)
    {
        $content = OrderContent::find()->where(['status' => self::STATUS_ACTIVE, 'order_id' => $order_id, 
                'parent_id' => self::MAIN_PARENT])->orderBy(['rating' => SORT_DESC, 'item' => SORT_ASC])->all();
        $content = self::executeMethods($content, ['countWeightAll']);
        return $content;
    }
    
    public function countWeightAll()
    {
        $this->weightAll = OrderLogic::countWeightOfAll($this->weight, $this->count);
        return $this;
    }
    
    public function saveParamsFromObject($object)
    {
        $order_id = OrderLogic::getActiveOrderId();
        OrderLogic::setParamsFromObject($this, $object, $order_id);
        $this->save();
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
    

}





