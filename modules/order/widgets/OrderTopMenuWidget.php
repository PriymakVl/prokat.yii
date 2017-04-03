<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderTopMenuWidget extends Widget 
{
    public $order_id;

    public function run()
    {
        if (Yii::$app->controller->id == 'order-content' && Yii::$app->controller->action->id == 'list') $action = 'content';
        else if (Yii::$app->controller->id == 'order') $action = Yii::$app->controller->action->id;
        return $this->render('top', ['order_id' => $this->order_id, 'action' => $action]);
    }

}

