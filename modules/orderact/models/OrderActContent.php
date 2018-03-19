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
    
    const PAGE_SIZE = 15;
    
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
        $order = Order::findOne($item->order_id);
        if ($order) $this->customer = $order->customer;
        $this->act_id = $act_id;
        $this->order_id = $item->order_id;
        $this->item_id = $item->id;
        $this->code = $item->code;
        $this->drawing = $item->drawing;
        $this->month_receipt = date('m');
        $this->year_receipt = date('Y');
        $this->name = $item->name;
        $this->state = self::STATE_RECEIVED;
        return $this;
    }
    //if not is save where registration act
    public function getName()
    {
        if (!$this->name) $this->name = $this->item->name;
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
        if ($this->order) $this->order->getNumber();
        return $this;
    }
    
    public function getAct()
    {
        $this->act = OrderAct::findOne($this->act_id);
        $this->act->month = OrderActLogic::getMonthString($this->act->month, true);
        return $this;    
    }
    
    public function getItemOrder()
    {
        if ($this->item_id) $this->item = OrderContent::findOne($this->item_id);
        return $this;
    }
    
    public static function getContent($params)
    {
        $list = self::find()->filterWhere($params)->all();
        return self::executeMethods($list, ['getAct', 'getOrder', 'getItemOrder']);
    }
}





