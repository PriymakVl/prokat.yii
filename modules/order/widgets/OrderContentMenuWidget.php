<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderContentMenuWidget extends Widget 
{
    public $item_id;
    public $order_id;

    public function run()
    {
        $action = Yii::$app->controller->action->id;
        return $this->render('order_content_menu', ['item_id' => $this->item_id, 'order_id' => $this->order_id, 'action' => $action]);
    }

}

