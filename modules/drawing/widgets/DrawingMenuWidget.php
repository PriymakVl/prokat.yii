<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingMenuWidget extends Widget 
{
    public $dwg_id;

    public function run()
    {
        if (Yii::$app->controller->id == 'drawing-works') $type = 'works';
        else if (Yii::$app->controller->id == 'drawing-department') $type = 'department';

        return $this->render('drawing', ['type' => $type, 'dwg_id' => $this->dwg_id]);
    }

}

