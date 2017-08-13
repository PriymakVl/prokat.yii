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
    
    const PAGE_SIZE = 15;
    
    const STATE_ACTIVE = 1;
    const STATE_CANCELED = 2;
    const STATE_PASSED = 3;
    
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
        $this->order->getNumber();
        return $this;
    }
    
    public static function getActList($params)
    {
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['date_registr' => SORT_DESC])->all();
        return self::executeMethods($list, ['getOrder', 'convertState', 'getContent', 'convertMonth']);
    }
    
    public function convertState()
    {
        $this->state = OrderActLogic::convertState($this->state);
        return $this;
    }
    
    public function registration($number, $order_id)
    {
        $data_registr = time();
        $month = date('n');
        $year = date('Y');
        $state = OrderAct::STATE_ACTIVE;
        $sql = "INSERT INTO `".self::tableName()."` (`number`, `order_id`, `date_registr`, `month`, `year`, `state`) 
                VALUES ($number, $order_id, $data_registr, $month, $year, $state)";
        \Yii::$app->db->createCommand($sql)->execute();
        return \Yii::$app->db->getLastInsertID();
    }

}




