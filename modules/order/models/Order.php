<?php

namespace app\modules\order\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\order\logic\OrderLogic;
use app\modules\employees\logic\EmployeeLogic;
use app\modules\employees\models\Employee;

class Order extends BaseModel
{
    public $content;
    public $sectionName;
    public $equipmentName;
    public $unitName;
    
    const PAGE_SIZE = 15;
    
    const STATE_DRAFT = 1;
    const STATE_ACTIVE = 2;
    const STATE_CLOSED = 3;
    const STATE_NOT_ACCEPTED = 4;//не принят
    const STATE_PERFORMED = 5;   //заказ выполнен
    
    const KIND_CURRENT = 1;
    const KIND_PERMANENT = 2;
    const KIND_ANNUAL = 3;//годовой

    const PERIOD_UNDEFINED = 1;
    const PERIOD_2010_2015 = 2;
    const PERIOD_2015_2017 = 3;
    const CURRENT_PERIOD = 4;

    const TYPE_ENHANCEMENT = 1; //улучшение
    const TYPE_MAKING = 4; //изготовление
    const TYPE_MAINTENANCE = 5; //текущий ремонт
    const TYPE_CAPITAL_REPAIR = 6; // капитальный ремонт

    //const ORDER_STATE_PART_MANUFACTURED = 4;
    //const ORDER_STATE_MANUFACTURED = 5;
    
    
    public static function tableName()
    {
        return 'orders';
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    
    public static function get($order_id)
    {
        $order = self::getOne($order_id, false, self::STATUS_ACTIVE);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder()
                ->getFullCustomer()->getFullIssuer()->convertLocation()->convertState()->convertPeriod()->checkActive('order-active')
                ->convertKind();
        return $order;   
    }
    
    public function getContent()
    {
        $this->content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $this->id]);
    }
    
    public function getNumber()
    {
        if ($this->number) $this->number = '27.'.$this->number.'.'.$this->type;
        else $this->number = 'Не указан';
        return $this;
    }
    
    public static function getOrderList($params)
    {
        //if ($params['state'] == self::STATE_DRAFT) $query = self::find()->where($params);
        //else if ($params['state'] == self::STATE_PERMANENT) $query = self::find()->where($params);
        //else $query = self::find()->where($params)->andWhere(['!=', 'state', self::STATE_DRAFT]);
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['number' => SORT_DESC])->all();
        return self::executeMethods($list, ['getNumber', 'getShortCustomer', 'getContent']);
    }
    
    public static function getListForFile($ids)
    {
        $ids = trim($ids);
        $sql = 'SELECT * FROM `orders` WHERE `id` IN('.$ids.')  ORDER BY `number` DESC';
        $list = self::findBySql($sql)->all();
        return self::executeMethods($list, ['getNumber', 'convertServiceForFile', 'convertDateForFile', 'getCustomerForPrint']);
    }
    
    public function convertType()
    {
        $this->type = OrderLogic::convertType($this->type);
        return $this;
    }
    
    public function convertKind()
    {
        $this->kind = OrderLogic::convertKind($this->kind);
        return $this;
    }
    
    public function convertServiceForFile()
    {
        return parent::convertService($this);
    }
    
    public function convertDateForFile()
    {
        return parent::convertDate($this, false, 'd.m.y');
    }
    
    public function countWeightOrder()
    {
        if (!$this->weight) {
            $weight = OrderLogic::countWeightOfOrder($this->id);
            $this->weight = OrderLogic::removeZerosFromWeight($weight);    
        }
        return $this;
    }
    
//    public static function searchByNumber($number)
//    {
//        $orders = self::findAll(['number' => trim($number)]);
//        if (count($orders) > 1) self::executeMethods($orders, ['getNumber', 'convertPeriod', 'getShortCustomer']);
//        return $orders;
//    }
    
    public function getFullCustomer()
    {
        //if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        if ((int)$this->customer) $this->customer = EmployeeLogic::getFullName($this->customer);
        return $this;
    }
    
    public function getShortCustomer()
    {
        //if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName($this->customer);
        return $this;
    }
    
    public function getCustomerForPrint()
    {
        //if ((int)$this->customer === 0) $this->customer = 'Не указан';
        if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName($this->customer);
        return $this;  
    }
    
    public function getFullIssuer()
    {
        //if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        if ((int)$this->issuer) $this->issuer = EmployeeLogic::getFullName($this->issuer);
        return $this;
    }
    
    public function getShortIssuer()
    {
        //if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        if ((int)$this->issuer) $this->issuer = EmployeeLogic::getShortName($this->issuer);
        return $this;
    }
    
    public function getWork($html = true)
    {
        if ($this->work) $this->work = OrderLogic::convertWork($this->work, $html);
        return $this;
    }
    
//    public function getWeight()
//    {
//        if ($this->weight) $this->weight = OrderLogic::removeZerosFromWeight($this->weight);
//        return $this;
//    }
    
    public function convertPeriod()
    {
        $this->period = OrderLogic::convertPeriod($this->period);
        return $this;
    }
    
    public function convertLocation()
    {
        $this->sectionName = OrderLogic::convertLocation($this->section);
        $this->equipmentName = OrderLogic::convertLocation($this->equipment);
        $this->unitName = OrderLogic::convertLocation($this->unit);
        return $this;
    }
    
    public function convertState()
    {
        switch ($this->state) {
            case Order::STATE_DRAFT: $this->state = '<span style="color:red;">Черновик</span>'; break;
            case Order::STATE_ACTIVE: $this->state = 'Выдан'; break;
            case Order::STATE_NOT_ACCEPTED: $this->state = '<span style="color:red;">Не принят</span>'; break;
            case Order::STATE_CLOSED: $this->state = '<span style="color:red;">Закрыт</span>'; break;
            default: $this->state = 'Выдан';
        }
        return $this;
    }

}




