<?php

namespace app\modules\order\widgets;

use yii\base\Widget;

class OrderActiveMenuWidget extends Widget 
{
    public $order_id;

    public function run()
    {
        return $this->render('order_active', ['order_id' => $this->order_id]);
    }

}

