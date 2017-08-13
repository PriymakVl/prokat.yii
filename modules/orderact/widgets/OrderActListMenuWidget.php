<?php

namespace app\modules\orderact\widgets;

use Yii;
use yii\base\Widget;

class OrderActListMenuWidget extends Widget 
{
    public $state;
    
    public function run()
    {
        return $this->render('menu_list', ['state' => $this->state]);
    }

}

