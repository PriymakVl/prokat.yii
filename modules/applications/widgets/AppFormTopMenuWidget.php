<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;

class AppFormTopMenuWidget extends Widget 
{

    public function run()
    {
        if (Yii::$app->controller->id == 'application') $template = 'top_app_form';
        else $template = 'top_app_content_form';
        return $this->render($template);
    }

}

