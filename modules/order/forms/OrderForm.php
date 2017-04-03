<?php

namespace app\modules\order\forms;

use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\Order;

class OrderForm extends BaseForm
{   
    const STATUS_DRAFT = 2;
    
    public $name;
    public $issuer;
    public $customer;
    public $number;
    public $mechanism;
    public $unit;
    public $date;
    public $weight;
    public $service;
    public $type;
    public $note;
    public $work;
    public $description;
    //form
    public $order_id;

    
    public function rules() 
    {
        return [
            [['name', 'type', 'mechanism', 'unit', 'description'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['issuer', 'customer'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['name', 'string'],
            ['type', 'integer'],
            ['service', 'string'],
            ['note', 'string',],
            ['issuer', 'string'],
            ['customer', 'string'],
            ['number','string'],
            ['work','string'],
            ['weight','string'],
            ['date','string'],
        ];

    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }


    public function save($order) 
    {
        if (!$order) $order = new Order();
        $order = $this->updateData($order);
        if (!$order->save()) return false;
        $this->order_id = $order->id;
        return true;  
    }
    
    private function updateData($order)
    {
        $order->type = $this->type;
        $order->name = $this->name;
        $order->issuer = $this->issuer;
        $order->customer = $this->customer;
        $order->note = $this->note;
        $order->service = $this->service;
        if ($this->date) $order->date = strtotime($this->date);
        else $order->date = time();
        if ($this->date) $order->year = date('Y', strtotime($this->date));
        else $order->year = date('Y', time());
        $order->work = $this->work;
        $order->weight = $this->weight;
        $order->unit = $this->unit;
        $order->mechanism = $this->mechanism;
        $order->description = $this->description;
        if ($this->number && $this->number != 'черновик') {
            $order->number = $this->number; 
            $order->status = self::STATUS_ACTIVE;   
        }
        else {
            $order->number = 'черновик';
            $order->status = self::STATUS_DRAFT;
        }
        return $order;
    }



}

