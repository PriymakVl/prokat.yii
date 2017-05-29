<?php

namespace app\modules\applications\widgets;

use yii\base\Widget;

class AppMenuWidget extends Widget 
{
    public $app_id;

    public function run()
    {
        return $this->render('application', ['app_id' => $this->app_id]);
    }

}

