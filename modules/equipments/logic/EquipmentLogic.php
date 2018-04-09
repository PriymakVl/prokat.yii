<?php

namespace app\modules\equipments\logic;

use yii\helpers\Url;
use app\logic\BaseLogic;
use app\modules\equipments\models\EquipmentGroup;
use app\modules\equipments\models\Equipment;

class EquipmentLogic extends BaseLogic
{
    

    public static function getBreadcrumbsGroup($id)
    {
        if (empty($id)) return false;
        $parent = null;
        $item = EquipmentGroup::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        if (empty($item)) return false;

        if ($item->parent_id) $parent = EquipmentGroup::findOne(['id' => $item->parent_id, 'status' => self::STATUS_ACTIVE]);
        else return "<a href='/equipment/group/list'>группы</a> > <span item_id='{$item->id}'>{$item->name}</span>";

        $url_sub = '/equipment/group/list?parent_id='.$item->parent_id;
        if ($parent && $parent->parent_id == 0) return "<a href='/equipment/group/list'>группы</a> > <a href='{$url_sub}'>{$parent->name}</a> > <span item_id='{$item->id}'>{$item->name}</span>";
    }

    public static function getBreadcrumbsSection($id)
    {
        if (empty($id)) return false;
        $parent = null;
        $item = Equipment::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        if (empty($item)) return false;

        if ($item->parent_id) $parent = Equipment::findOne(['id' => $item->parent_id, 'status' => self::STATUS_ACTIVE]);
        else return "<a href='/equipment/list'>группы</a> > <span item_id='{$item->id}'>{$item->name}</span>";

        $url_sub = '/equipment/list?parent_id='.$item->parent_id;
        if ($parent && $parent->parent_id == 0) return "<a href='/equipment/list'>группы</a> > <a href='{$url_sub}'>{$parent->name}</a> > <span item_id='{$item->id}'>{$item->name}</span>";
    }


}





