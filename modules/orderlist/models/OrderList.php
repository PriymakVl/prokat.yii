<?php

namespace app\modules\orderlist\models;

use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\orderlist\logic\OrderListLogic;
use app\modules\orderlist\models\OrderListContent;

class OrderList extends BaseModel
{
    public $content;
    
    const PAGE_SIZE = 15;
    const TYPE_LETTER = 'letter';
    const TYPE_MONTH = 'month';
    const TYPE_CAPITAL = 'capital';
    const TYPE_OTHER = 'other';
      
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
        $this->content = OrderListContent::findAll(['status' => self::STATUS_ACTIVE, 'list_id' => $this->id]);
    }
    
    public static function getList($params)
    {
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all();
        return self::executeMethods($list, []);
    }
    
    

}




