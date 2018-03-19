<?php

namespace app\modules\chain\models;

use app\models\BaseModel;
use app\modules\chain\logic\ChainLogic;

class Chain extends BaseModel
{
    public $obj;
    public $iso;
    public $gost;

    public static function tableName()
    {
        return 'mod_chains';
    }
    
    public static function getChainList($params)
    {
           $list = self::find()->filterWhere($params)->all();
           $list = self::executeMethods($list, ['getObject', 'getIso']);
           return $list;
//        return ChainLogic::cutNotes($list);
    }

    public function getIso()
    {
        if ($this->iso_id) {
            $this->iso = ChainIso::getOne($this->iso_id, false, self::STATUS_ACTIVE);
            //
        }
        return $this;
    }



}





