<?php

namespace app\modules\orderact\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;

class OrderActLogic extends BaseLogic
{

    public static function getParams($mounth, $year, $state)
    {
        $params['status'] = self::STATUS_ACTIVE;
        $params['mounth'] = $mounth;
        $params['year'] = $year;
        $params['state'] = $state;
        return $params;   
    }
    
    public static function convertState($state)
    {
        switch ($state) {
            case OrderAct::STATE_ACTIVE: return '<span style="color:red;">Оформляется</span>';
            case OrderAct::STATE_CANCELED: return '<span style="color:grey;">Анулирован</span>';
            case OrderAct::STATE_PASSED: return '<span style="color:green;">Сдан</span>'; 
        }
    }

}





