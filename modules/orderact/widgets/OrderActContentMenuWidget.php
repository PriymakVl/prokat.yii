<?php

namespace app\modules\orderact\widgets;

use yii\base\Widget;

class OrderActContentMenuWidget extends Widget 
{
    public $act;

    public function run()
    {
        return $this->render('menu_content', ['act' => $this->act]);
    }

}

