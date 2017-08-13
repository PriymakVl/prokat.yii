<?php

namespace app\modules\orderlist\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\orderlist\logic\OrderListLogic;
use app\modules\orderlist\models\OrderList;

class OrderListForm extends BaseForm
{   
    
    public $name;
    public $note;
    public $out_num;
    public $out_date;
    public $type;
    //form
    public $list_id;
    
    public function rules() 
    {
        return [
            [['name', 'type' ], 'required', 'message' => 'Необходимо заполнить поле'],
            ['name', 'string'],
            ['type', 'string'],
            ['note', 'string',],
            ['out_num', 'integer'],
            [['out_date'], 'date', 'format' => 'php:d.m.y', 'message' => 'Неправильный формат даты'],
            ['out_date', 'default', 'value' => ''],
        ];

    }
    
    
    
    public function behaviors()
    {
    	return ['order-list-logic' => ['class' => OrderListLogic::className()]];
    }
    
    public function save($list) 
    {
        if (!$list) $list = new OrderList();
        $list = $this->updateData($list);
        if (!$list->save()) return false;
        $this->list_id = $list->id;
        return true;  
    }
    
    private function updateData($order)
    {
        $order->type = $this->type;
        $order->name = $this->name;
        $order->note = $this->note;
        $order->out_num = $this->out_num;
        $order->out_date = ($this->out_num && $this->out_date) ? strtotime($this->prepareDateForConvert($this->out_date)) : '';
        return $order;
    }
    
}


