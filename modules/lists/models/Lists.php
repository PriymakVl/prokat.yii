<?php

namespace app\modules\lists\models;

use Yii;
use app\models\BaseModel;
use app\modules\lists\models\ListContent;
use app\modules\lists\logic\ListLogic;

class Lists extends BaseModeL
{
    const PAGE_SIZE = 15;

    public static function tableName()
    {
        return 'lists';
    }
	
	public function behaviors()
    {
        return ['list-logic' => ['class' => ListLogic::className()]];
    }

    public function convertType()
    {
        $this->type = $this->convertTag('list', $this->type);
        return $this;
    }
    
    public static function getOneList()
    {
        $list_id = ListLogic::getActiveList();
        return self::getOne($list_id, false, self::STATUS_ACTIVE);
    }
    
    public static function getAllList($params)
    {
        return parent::getList($params, self::PAGE_SIZE);
    }

    public function checkActive($session_name)
    {
        return parent::checkActive($session_name); // TODO: Change the autogenerated stub
    }


}





