<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        return $this->render('menu/object', ['obj_id' => $this->obj_id]);
    }

}

