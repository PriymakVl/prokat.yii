<?php

namespace app\modules\objects\widgets;

use Yii;
use yii\base\Widget;

class ObjectTopMenuWidget extends Widget 
{
    public $obj_id;

    public function run()
    {
        if (Yii::$app->controller->id == 'object-drawing') $page = 'drawing';
        else if (Yii::$app->controller->id == 'object-specification') $page = 'specification';
        else $page = 'object';
        
        return $this->render('menu/object_top', ['obj_id' => $this->obj_id, 'page' => $page]);
    }

}

