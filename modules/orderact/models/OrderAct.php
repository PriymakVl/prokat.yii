<?php

namespace app\modules\orderact\models;

use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\order\models\Order;

class OrderAct extends BaseModel
{
    public $content;
    public $order;
    public $period;
    public $colorState;
    
    const PAGE_SIZE = 15;
    
    const STATE_PROCESSED = 1;
    const STATE_PASSED = 2;
    const STATE_CANCELED = 3;
    
    public static function tableName()
    {
        return 'order_act';
    }
    
    public function behaviors()
    {
    	return ['order-logic-act' => ['class' => OrderActLogic::className()]];
    }
    
    public function getContent()
    {
        $this->content = OrderActContent::findOne(['status' => self::STATUS_ACTIVE, 'act_id' => $this->id]);
        return $this;
    }
    
    public function getOrder()
    {
        $this->order = Order::findOne($this->order_id);
        $this->order->getNumber()->getCustomerForPrint();
        return $this;
    }
    
    public static function getActList($params)
    {
        $list = self::findAll($params);
        return self::executeMethods($list, ['getOrder', 'getColorState']);
    }
    
    public function convertState()
    {
        $this->state = OrderActLogic::convertState($this->state);
        return $this;
    }
    
    public function registration($number, $order_id)
    {
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $data_registr = time();
        $month = date('n');
        $year = date('Y');
        $state = OrderAct::STATE_PROCESSED;
        $sql = "INSERT INTO `".self::tableName()."` (`number`, `order_id`, `date_registr`, `month`, `year`, `state`, `type`) 
                VALUES ($number, $order_id, $data_registr, $month, $year, $state, $order->type)";
        \Yii::$app->db->createCommand($sql)->execute();
        return \Yii::$app->db->getLastInsertID();
    }
    
    public function convertDepartment()
    {
        $this->department = OrderActLogic::convertDepartment($this->department);
        return $this;
    }
    
    public function getPeriod()
    {
        $this->period = OrderActLogic::getPeriod($this);
        return $this;
    }
    
    public static function searchByNumber($number)
    {
        $acts = self::findAll(['number' => $number, 'status' => self::STATUS_ACTIVE]);
        if (!$acts) return false;
        return self::executeMethods($acts, ['getOrder', 'getPeriod', 'convertDepartment']);
    }
    
    public function getColorState()
    {
        if ($this->state == self::STATE_PROCESSED) $this->colorState = 'red';
        else if ($this->state == self::STATE_PASSED) $this->colorState = 'green';
        else $this->colorState = 'grey';
        return $this;
    }

}




