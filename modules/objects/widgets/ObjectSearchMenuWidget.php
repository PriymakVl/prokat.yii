<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectSearchMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        return $this->render('menu/object_search');
    }

}

