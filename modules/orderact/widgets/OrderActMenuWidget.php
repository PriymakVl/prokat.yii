<?php

namespace app\modules\orderact\widgets;

use yii\base\Widget;

class OrderActMenuWidget extends Widget 
{
    public $act;

    public function run()
    {
        return $this->render('menu_act', ['act' => $this->act]);
    }

}

