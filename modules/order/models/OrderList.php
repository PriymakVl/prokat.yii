<?php

namespace app\modules\order\models;

use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\order\logic\OrderListLogic;

class OrderList extends BaseModel
{
    public $content;
    
    const PAGE_SIZE = 15;
    
    public static function tableName()
    {
        return 'order_list';
    }
    
    public function behaviors()
    {
    	return ['order-list-logic' => ['class' => OrderListLogic::className()]];
    }
    
    public function getContent()
    {
        $this->content = OrderListContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $this->id]);
    }
    
    public function getNumber()
    {
        if ($this->number) $this->number = '27.'.$this->number.'.'.$this->type;
        else $this->number = 'Не указан';
        return $this;
    }
    
    public static function getList($params)
    {
        $query = self::find()->where($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['number' => SORT_DESC])->all();
        return self::executeMethods($list, ['convertType', 'getContent']);
    }
    
//    public static function getListForFile($ids)
//    {
//        $ids = trim($ids);
//        $sql = 'SELECT * FROM `orders` WHERE `id` IN('.$ids.')  ORDER BY `number` DESC';
//        $list = self::findBySql($sql)->all();
//        return self::executeMethods($list, ['getNumber', 'convertServiceForFile', 'convertDateForFile', 'getCustomerForPrint']);
//    }
    
    public function convertType()
    {
        $this->type = OrderListLogic::convertType($this->type);
        return $this;
    }
    
}




