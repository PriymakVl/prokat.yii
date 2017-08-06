<?php

namespace app\modules\orderlist\models;

use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\orderlist\logic\OrderListLogic;
use app\modules\orderlist\models\OrderList;

class OrderListContent extends BaseModel
{
      
    public static function tableName()
    {
        return 'order_list_content';
    }
    
    public function behaviors()
    {
    	return ['order-list-logic' => ['class' => OrderListLogic::className()]];
    }
    
    
    

}




