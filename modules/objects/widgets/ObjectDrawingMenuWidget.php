<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectDrawingMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        return $this->render('menu/object_drawing', ['obj_id' => $this->obj_id]);
    }

}

