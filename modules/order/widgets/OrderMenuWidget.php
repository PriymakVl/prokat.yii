<?php

namespace app\modules\order\widgets;

use yii\base\Widget;

class OrderMenuWidget extends Widget 
{
    public $order_id;

    public function run()
    {
        return $this->render('order', ['order_id' => $this->order_id]);
    }

}

