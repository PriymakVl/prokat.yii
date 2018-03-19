<?php

namespace app\modules\chain\models;

use app\models\BaseModel;
use app\modules\chain\logic\ChainLogic;

class ChainIso extends BaseModel
{

    public static function tableName()
    {
        return 'mod_chain_iso';
    }

    public static function getChainList($params)
    {
        $iso = self::find()->filterWhere($params)->all();
        return $iso;
    }

}





