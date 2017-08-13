<?php

namespace app\modules\orderlist\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\orderlist\models\OrderList;
use app\modules\orderlist\models\OrderListContent;

class OrderListLogic extends BaseLogic
{

    public static function getParams($type)
    {
        $params['status'] = self::STATUS_ACTIVE;
        $params['type'] = $type;
        return $params;   
    }
    
    public static function convertType($type)
    {
        switch($type) {
            case OrderList::TYPE_CAPITAL : return 'Капитальный ремонт'; break;
            case OrderList::TYPE_MONTH : return 'План на месяц'; break;
            case OrderList::TYPE_LETTER : return 'Письмо'; break;
        }
    }
    


}





