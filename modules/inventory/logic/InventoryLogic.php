<?php

namespace app\modules\inventory\logic;

use Yii;
use app\logic\BaseLogic;
use app\modules\inventory\models\Inventory;

class InventoryLogic extends BaseLogic
{
    

    public static function getParams($cat)
    {
        $params['status'] = self::STATUS_ACTIVE;
        $params['category'] = $cat;
        return $params;   
    }
    
    public static function convertCategory($cat)
    {
        switch($cat) {
            case 'mill' : return 'Стан'; break;
            case 'cart' : return 'Транспортные тележки'; break;
            case 'loop' : return 'Петлеобразователи'; break;
            case 'sundbirsta' : return 'Оборудование Sundbirsta'; break;
            case 'finish' : return 'Оборудование отделки'; break;
            case 'shear' : return 'Ножницы'; break;
            case 'sliting' : return 'Слитинг'; break;
            case 'crane' : return 'Краны'; break;
            case 'pinch-roll' : return 'Трайб-аппараты'; break;
            case 'bunt' : return 'Бунтовая линия'; break;
            case 'roller' : return 'Рольганги'; break;
            case 'stock' : return 'Хранение'; break;
            case 'gydro' : return 'Система гидравлики'; break;
            case 'grease' : return 'Система смазки'; break;
            case 'sort' : return 'Сортовая линия'; break;
            case 'talie' : return 'Тали'; break;
            case 'stand' : return 'Клети'; break;
            case 'building' : return 'Здания'; break;
            default : return 'Без категории';
        }
    }
    
}





