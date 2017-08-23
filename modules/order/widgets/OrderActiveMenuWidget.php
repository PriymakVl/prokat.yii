<?php

namespace app\modules\order\widgets;

use yii\base\Widget;
use app\modules\order\logic\OrderLogic;

class OrderActiveMenuWidget extends Widget 
{
    public $order_id;

    public function run()
    {
        $active_id = OrderLogic::getActive('order-active');
        return $this->render('order_active', ['active_id' => $active_id, 'order_id' => $this->order_id]);
    }

}

