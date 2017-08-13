<?php

namespace app\modules\orderact\models;

use app\models\BaseModel;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\order\models\OrderContent;

class OrderActContent extends BaseModel
{
    public $dwg;
    public $name;
    public $obj_id;
    
    public static function tableName()
    {
        return 'order_act_content';
    }
    
    public function behaviors()
    {
    	return ['order-logic-act' => ['class' => OrderActLogic::className()]];
    }
    
    public static function setContentWhenRegistrationAct($act_id, $ids)
    {
        $items = OrderContent::findAll(explode(',', $ids));
        foreach ($items as $item) {
            $sql = "INSERT INTO `".self::tableName()."` (`act_id`, `item_id`, `count`) VALUES ($act_id, $item->id, $item->count)";
            \Yii::$app->db->createCommand($sql)->execute();
        }
        return true;
    }

    public static function getContentByActId($act_id)
    {
        $content = self::findAll(['act_id' => $act_id, 'status' => STATUS_ACTIVE]);
        foreach ($content as $obj) {
            $item = OrderContent::findOne(['id' => $obj->item_id]);
            $obj->name = $item->name;
            $obj->dwg = $item->dwg;
            $obj->obj_id = $item->obj_id;
        }
        return $content;
    }
}





