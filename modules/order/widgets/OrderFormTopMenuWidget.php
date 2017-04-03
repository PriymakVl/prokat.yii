<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderFormTopMenuWidget extends Widget 
{

    public function run()
    {
        if (Yii::$app->controller->id == 'order') $template = 'top_order_form';
        else $template = 'top_content_form';
        return $this->render($template);
    }

}

