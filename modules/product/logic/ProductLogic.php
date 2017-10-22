<?php

namespace app\modules\product\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\product\models\Product;
//use app\modules\objects\models\Objects;
use app\modules\orderact\models\OrderActContent;
//use app\modules\objects\logic\ObjectLogic;
//use app\modules\drawing\logic\DrawingLogic;
//use app\modules\equipments\models\Equipment;

class ProductLogic extends BaseLogic
{
    
    

    public static function getParamsManufactured($code, $state = null, $month = null, $year = null, $order = null)
    {
        $parans = [];
        $params['status'] = self::STATUS_ACTIVE;
        $params['month'] = $month;
        $params['year'] = $year;
        $params['code'] = $code;
        $params['state'] = OrderActContent::STATE_RECEIVED;
        return $params;   
    }
    

}





