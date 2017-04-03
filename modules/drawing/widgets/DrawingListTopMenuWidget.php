<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingListTopMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        if (Yii::$app->controller->id == 'drawing-works') $template = 'list_works_top';
        else if (Yii::$app->controller->id == 'drawing-department') $template = 'list_department_top';
        return $this->render($template, ['params' => $this->params]);
    }

}

