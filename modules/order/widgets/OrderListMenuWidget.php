<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderListMenuWidget extends Widget 
{

    public function run()
    {
        $action = Yii::$app->controller->action->id;
        return $this->render('order_list', compact('action'));
    }

}

