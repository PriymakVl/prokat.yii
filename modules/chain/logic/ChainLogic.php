<?php

namespace app\modules\chain\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\chain\models\Chain;

class ChainLogic extends BaseLogic
{

    public static function getParamsChains()
    {

        $params['equipment'] = Yii::$app->request->get('equipment');
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }

    public static function getParamsChainsIso()
    {
        //$params['equipment'] = Yii::$app->request->get('equipment');
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }
    
}





