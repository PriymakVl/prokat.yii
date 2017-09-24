<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderFormInventoryMenuWidget extends Widget 
{
    public $order_id;

    public function run()
    {
        $categories = [];
        return $this->render('top_form_inventory_menu', ['categories' => $categories]);
    }

}

