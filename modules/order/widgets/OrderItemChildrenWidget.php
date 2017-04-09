<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderItemChildrenWidget extends Widget 
{
    public $children;

    public function run()
    {
        return $this->render('order_item_children', ['children' => $this->children]);
    }

}

