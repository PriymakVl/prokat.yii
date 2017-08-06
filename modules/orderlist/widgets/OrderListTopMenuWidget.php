<?php

namespace app\modules\orderlist\widgets;

use Yii;
use yii\base\Widget;

class OrderListTopMenuWidget extends Widget 
{
    public $list_id;

    public function run()
    {
        return $this->render('top_menu', ['list_id' => $this->list_id]);
    }

}

