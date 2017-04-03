<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectListMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        return $this->render('menu/object_list', ['obj_id' => $this->obj_id]);
    }

}

