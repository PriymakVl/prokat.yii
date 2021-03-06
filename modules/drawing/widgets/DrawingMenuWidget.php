<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingMenuWidget extends Widget 
{
    public $dwg_id;

    public function run()
    {
        if (Yii::$app->controller->id == 'drawing-works') $template = 'dwg_works_menu';
        else if (Yii::$app->controller->id == 'drawing-department') $template = 'dwg_draft_menu';
        return $this->render($template, ['dwg_id' => $this->dwg_id]);
    }

}

