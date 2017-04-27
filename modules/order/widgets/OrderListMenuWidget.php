<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderListMenuWidget extends Widget 
{
    public $state;
    
    public function run()
    {
        return $this->render('order_list', ['state' => $this->state]);
    }

}

