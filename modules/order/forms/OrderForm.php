<?php

namespace app\modules\order\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\Order;
use app\modules\equipments\models\Equipment;

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
    public $period;
    public $state;
    public $area;
    //form
    public $order_id;
    public $areaAll;
    
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
            ['number','integer'],
            ['work','string'],
            ['weight','string'],
            ['date','string'],
            ['period', 'integer'],
            ['area', 'string'],
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
        $order->area = $this->area;
        $order->name = $this->name;
        $order->issuer = $this->issuer;
        $order->customer = $this->customer;
        $order->note = $this->note;
        $order->service = $this->service;
        $order->date = strtotime($this->prepareDateForConvert($this->date));
        //$order->year = date('Y', $order->date);
        $order->work = $this->setWork();
        $order->weight = $this->weight;
        $order->unit = $this->unit;
        $order->mechanism = $this->mechanism;
        $order->description = $this->description;
        $order->number = $this->number;
        $order->state = $this->getState();
        $order->period = OrderLogic::getPeriod($order->date);
        return $order;
    }
    
    public function getArea()
    {
        $this->areaAll = Equipment::getArea();
    }
    
    public function setWork()
    {
        if (!$this->work) return false;
        $pattern = '#<li>(.+?)<\\/li>#is';//get value betwen tags li
        preg_match_all($pattern, $this->work, $matches);
        if (empty($matches[1])) return false;
        else return serialize($matches[1]);
    }
    
    public function getState()
    {
        if ($order->state) return $order->state;
        if (!$this->number) return Order::STATE_DRAFT;
        else return Order::STATE_ACTIVE;
    }



}

