<?php

namespace app\modules\orderact\models;

use app\models\BaseModel;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\order\models\OrderContent;
use app\modules\order\models\Order;

class OrderActContent extends BaseModel
{
    public $item;
    public $order;
    public $act;
    
    const STATE_RECEIVED = 1;
    const STATE_INSTALLED = 2;
    
    public static function tableName()
    {
        return 'order_act_content';
    }
    
    public function behaviors()
    {
    	return ['order-logic-act' => ['class' => OrderActLogic::className()]];
    }
    
    public function setDataWhenRegistrationAct($act_id, $item)
    {
        $this->act_id = $act_id;
        $this->order_id = $item->order_id;
        $this->item_id = $item->id;
        $this->code = $item->code;
        $this->state = self::STATE_RECEIVED;
        return $this;
    }

    public static function getContentByActId($act_id)
    {
        $content = self::findAll(['act_id' => $act_id, 'status' => self::STATUS_ACTIVE]);
        foreach ($content as $item) {
            $item->item = OrderContent::findOne(['id' => $item->item_id]);
            if ($item->item) $item->item->getPathDrawing()->getCodeObject();
        }
        return $content;
    }
    
    public function getOrder()
    {
        $this->order = Order::findOne($this->order_id);
        $this->order->getNumber();
        return $this;
    }
    
    public function getAct()
    {
        $this->act = OrderAct::findOne($this->act_id);
        $this->act->convertMonth($this->act->month);
        return $this;    
    }
}





