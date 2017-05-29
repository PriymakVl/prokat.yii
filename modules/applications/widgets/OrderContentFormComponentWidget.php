<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderContentFormComponentWidget extends Widget 
{
    public $template;

    public function run()
    {
        if ($this->template == 'material') $template = 'order_content_form_material';
        return $this->render($template);
    }

}

