<?php

namespace app\modules\orderlist\widgets;

use yii\base\Widget;

class OrderListMenuWidget extends Widget 
{
    public $list;

    public function run()
    {
        return $this->render('list', ['list' => $this->list]);
    }

}

