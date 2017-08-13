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
    
    public static function addOrder($order_id)
    {
        $session = Yii::$app->session;
        $list_id = $session->get('order-list-active');
        if (!$list_id) return false;
        $content = self::find()->select('order_id')->where(['list_id' => $list_id, 'status' => self::STATUS_ACTIVE])->column()->all();
        if (in_array($content, $order_id)) return $list_id;
        $item = new OrderListContent;
        $item->list_id = $list_id;
        $item->order_id = $order_id;
        if ($item->save()) return $list_id;
        return false;
    }
    
    
    

}




