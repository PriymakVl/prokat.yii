<?php

namespace app\components\drawingmenu;

use yii\base\Widget;

class DrawingObjectMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        return $this->render('drawing_object', ['obj_id' => $this->obj_id]);
    }

}

