<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingMainMenuWidget extends Widget {

    public function run()
    {
        return $this->render('drawing_main', ['controller' => Yii::$app->controller->id]);
    }

}

