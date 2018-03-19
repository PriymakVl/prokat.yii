<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectMenuWidget extends Widget 
{
    public $obj;

    public function run()
    {
        return $this->render('menu/object', ['obj' => $this->obj]);
    }

}

