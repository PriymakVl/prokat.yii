<?php

namespace app\modules\order\widgets;

use yii\base\Widget;
use app\modules\drawing\logic\DrawingLogic;
use app\models\InventoryNumber;

class OrderFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $order;
    public $item;
    public $object;

    public function run()
    {
        $inventories = [];
        if ($this->nameTab == 'inventory') $inventories = InventoryNumber::find()->where(['status' => InventoryNumber::STATUS_ACTIVE])->orderBy(['rating' => SORT_DESC])->all();
        $template = $this->getTemplate();
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'order' => $this->order, 'item' => $this->item, 
                'object' => $this->object, 'inventories' => $inventories]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'order_form_main'; break;
            case 'other': return 'order_form_other'; break;
            case 'work': return 'order_form_work'; break;
            case 'inventory': return 'order_form_inventory'; break;
        }
    }

}

