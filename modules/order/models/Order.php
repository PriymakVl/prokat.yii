<?php

namespace app\modules\order\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\order\logic\OrderLogic;

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
    
    public static function getList($params)
    {
        $list = parent::getList($params, self::PAGE_SIZE);
        return self::executeMethods($list, ['getNumber']);
    }
    
    public static function getListForFile()
    {
        $list = self::getAll();
        return self::executeMethods($list, ['getNumber', 'convertServiceForFile', 'convertDateForFile']);
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

}





