<?php

namespace app\modules\product\models;

use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\product\logic\ProductLogic;
use app\modules\orderact\models\OrderActContent;

class Product extends BaseModel
{
    public $receivedActs;
    public $objects;
    public $acts;
    
    const PAGE_SIZE = 15;
    
    public static function tableName()
    {
        return 'products';
    }
    
    public function behaviors()
    {
    	return ['product-logic' => ['class' => ProductLogic::className()]];
    }
    
    
//    public static function get($code)
//    {
//        $product = self::find()->where(['code' => $code, 'status' => self::STATUS_ACTIVE]);
//        if (!$product) return false;
//        $product->getObjects()->receivedByActs();
//        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder()
//                ->getFullCustomer()->getFullIssuer()->convertLocation()->convertState()->convertPeriod()->checkActive('order-active');
//        return $order;   
//    }
    
 //   public function getContent()
//    {
//        $this->content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'order_id' => $this->id]);
//    }

    public static function manufactured($params)
    {
        $query = OrderActContent::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $items = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all();
        if (!$items) return [];
        return self::executeMethods($items, ['getOrder', 'getAct']);
    }
    
   

}




