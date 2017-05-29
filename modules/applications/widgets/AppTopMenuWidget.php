<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;

class AppTopMenuWidget extends Widget 
{
    public $app_id;

    public function run()
    {
        if (Yii::$app->controller->id == 'application-content' && Yii::$app->controller->action->id == 'list') $action = 'content';
        else if (Yii::$app->controller->id == 'application') $action = Yii::$app->controller->action->id;
        return $this->render('top', ['app_id' => $this->app_id, 'action' => $action]);
    }

}

