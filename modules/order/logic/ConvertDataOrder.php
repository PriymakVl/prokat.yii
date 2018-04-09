<?php
namespace app\modules\order\logic;

use app\modules\order\models\Order;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\models\EquipmentGroup;


class ConvertDataOrder
{
    public static function convertType($type)
    {
        switch($type) {
            case Order::TYPE_ENHANCEMENT : return 'Улучшение'; break;
            case Order::TYPE_MAKING : return 'Изготовление'; break;
            case Order::TYPE_MAINTENANCE : return 'Текущий ремонт'; break;
            case Order::TYPE_CAPITAL_REPAIR : return 'Капитальный ремонт'; break;
        }
    }

    public static function convertKind($kind)
    {
        switch($kind) {
            case Order::KIND_CURRENT : return 'Разовый'; break;
            case Order::KIND_PERMANENT : return 'Постоянно действующий'; break;
            case Order::KIND_ANNUAL : return 'Годовой'; break;
            default : return 'Не определен';
        }
    }

    public static function convertPeriod($period)
    {
        switch ($period) {
            case 1: return 'Не известно';
            case 2: return '2011-2015';
            case 3: return '2015-2017';
            case 4: return 'Текущий';
            default: return 'Не известно';
        }
    }

    public static function convertWork($work, $html)
    {
        if (!$work) return false;
        $work = unserialize($work);
        if (!$html || !is_array($work)) return $work;
        else {
            $str = '<ol>';
            foreach ($work as $item) {
                $str .= '<li>'.$item.'</li>';
            }
            return $str .= '</ol>';
        }
    }

    public static function convertLocation($id)
    {
        if (!$id) return null;
        $item = Equipment::getOne($id, null, Equipment::STATUS_ACTIVE);
        if ($item) return $item->name;
        else return null;
    }

    public static function convertGroup($id)
    {
        if (!$id) return null;
        $item = EquipmentGroup::getOne($id, null, EquipmentGroup::STATUS_ACTIVE);
        if ($item) return $item->name;
        else return null;
    }
}