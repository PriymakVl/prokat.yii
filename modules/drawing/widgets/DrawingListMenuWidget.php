<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingListMenuWidget extends Widget 
{

    public function run()
    {
        if (Yii::$app->controller->id == 'drawing-works') $category = 'works';
        else if (Yii::$app->controller->id == 'drawing-department') $category = 'department';
        return $this->render('drawing_list', ['category' => $category]);
    }

}

