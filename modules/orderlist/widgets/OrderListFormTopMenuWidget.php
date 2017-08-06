<?php

namespace app\modules\orderlist\widgets;

use Yii;
use yii\base\Widget;

class OrderListFormTopMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('form_top_menu');
    }

}

