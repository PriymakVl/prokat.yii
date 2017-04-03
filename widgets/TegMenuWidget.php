<?php

namespace app\widget;

use yii\base\Widget;

class TegMenuWidget extends Widget 
{
    public $flag;

    public function run()
    {
       return $this->render('menu/teg', ['flag' => $this->flag]);
    }

}

