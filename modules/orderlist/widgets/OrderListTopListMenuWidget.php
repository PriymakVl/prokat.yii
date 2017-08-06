<?php

namespace app\modules\orderlist\widgets;

use Yii;
use yii\base\Widget;

class OrderListTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        return $this->render('top_list_menu', ['params' => $this->params]);
    }

}

