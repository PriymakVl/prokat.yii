<?php

namespace app\modules\orderact\widgets;

use yii\base\Widget;

class OrderActMenuWidget extends Widget 
{
    public $act_id;

    public function run()
    {
        return $this->render('menu_act', ['act_id' => $this->act_id]);
    }

}

