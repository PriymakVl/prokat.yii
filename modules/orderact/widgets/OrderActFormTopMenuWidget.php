<?php

namespace app\modules\orderact\widgets;

use Yii;
use yii\base\Widget;

class OrderActFormTopMenuWidget extends Widget 
{

    public function run()
    {
        if (Yii::$app->controller->id == 'order-act') $template = 'top_act_form';
        else $template = 'top_content_form';
        return $this->render($template);
    }

}

