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
    const STATUS_DRAFT = 2;
    
    
    public static function tableName()
    {
        return 'orders';
    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    public function getContent()
    {
        $this->content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $this->id]);
    }
    
    public function getNumber()
    {
        if ($this->number != 'черновик') $this->number = '27.'.$this->number.'.'.$this->type;
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
        $ids = explode(',', trim($ids));
        $list = self::findAll($ids);
        return self::executeMethods($list, ['getNumber', 'convertServiceForFile', 'convertDateForFile', 'getCustomerForPrint']);
    }
    
    public function convertType()
    {
        $this->type = OrderLogic::convertType($this->type);
        return $this;
    }
    
    public static function getDraft($order_id)
    {
        $order = self::findOne(['id' => $order_id, 'status' => self::STATUS_DRAFT]);
        if (!$order) throw new ForbiddenHttpException('error '.__METHOD__);
        else return $order;
    }
    
    public static function getDraftsList()
    {
        return self::findAll(['status' => self::STATUS_DRAFT]);
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
        $this->weight = OrderLogic::countWeightOfOrder($this->id);
        return $this;
    }
    
    public static function searchByNumber($number)
    {
        $orders = self::findAll(['number' => trim($number)]);
        if (count($orders) > 1) self::executeMethods($orders, ['getNumber']);
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

}





