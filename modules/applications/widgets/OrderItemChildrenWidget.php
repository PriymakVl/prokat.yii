<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderItemChildrenWidget extends Widget 
{
    public $parent;

    public function run()
    {
        return $this->render('order_item_children', ['parent' => $this->parent]);
    }

}

