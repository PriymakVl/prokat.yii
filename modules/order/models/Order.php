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
    public $weight;
    
    const PAGE_SIZE = 15;
    const STATE_DRAFT = 1;
    const STATE_ACTIVE = 2;
    //const ORDER_STATE_NOT_ACCEPTED = 3;
    //const ORDER_STATE_PART_MANUFACTURED = 4;
    //const ORDER_STATE_MANUFACTURED = 5;
    //const ORDER_STATE_CLOSED = 6;
    
    public static function tableName()
    {
        return 'orders';
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    
    public static function getOne($order_id)
    {
        $order = parent::getOne($order_id);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder()
                ->getFullCustomer()->getFullIssuer();
        return $order;   
    }
    
    public function getContent()
    {
        $this->content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $this->id]);
    }
    
    public function getNumber()
    {
        if ($this->state == self::STATE_DRAFT) $this->number = 'черновик'; 
        else $this->number = '27.'.$this->number.'.'.$this->type;
        return $this;
    }
    
    public static function getOrderList($params)
    {
        $query = self::find()->where($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['number' => SORT_DESC])->all();
        return self::executeMethods($list, ['getNumber', 'getShortCustomer']);
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
        $weight = OrderLogic::countWeightOfOrder($this->id);
        $this->weight = OrderLogic::removeZerosFromWeight($weight);
        return $this;
    }
    
    public static function searchByNumber($number)
    {
        $orders = self::findAll(['number' => trim($number)]);
        if (count($orders) > 1) self::executeMethods($orders, ['getNumber', 'convertPeriod', 'getShortCustomer']);
        return $orders;
    }
    
    public function getFullCustomer()
    {
        if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getFullName(Employee::getOne($this->customer));
        return $this;
    }
    
    public function getShortCustomer()
    {
        if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName(Employee::getOne($this->customer));
        return $this;
    }
    
    public function getCustomerForPrint()
    {
        if ((int)$this->customer === 0) $this->customer = 'Не указан';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName(Employee::getOne($this->customer));
        return $this;  
    }
    
    public function getFullIssuer()
    {
        if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->issuer) $this->issuer = EmployeeLogic::getFullName(Employee::getOne($this->issuer));
        return $this;
    }
    
    public function getShortIssuer()
    {
        if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->issuer = EmployeeLogic::getShortName(Employee::getOne($this->issuer));
        return $this;
    }
    
    public function getWork($html = true)
    {
        if ($this->work) $this->work = OrderLogic::convertWork($this->work, $html);
        return $this;
    }
    
    public function getWeight()
    {
        if ($this->weight) $this->weight = OrderLogic::removeZerosFromWeight($this->weight);
        return $this;
    }
    
    public function convertPeriod()
    {
        $this->period = OrderLogic::convertPeriod($this->period);
        return $this;
    }
    
    public function convertArea()
    {
        $this->area = OrderLogic::convertArea($this->area);
        return $this;
    }

}





