<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingWorksTopMenuWidget extends Widget 
{
    public $dwg;

    public function run()
    {
        if (Yii::$app->controller->action->id == 'index') $page = 'data';
        else if (Yii::$app->controller->action->id == 'specification') $page = 'specification';
        else $page = 'files';
        
        return $this->render('drawing_works_top', ['dwg_id' => $this->dwg->id, 'child' => $this->dwg->child, 'page' => $page]);
    }

}

