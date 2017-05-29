<?php

namespace app\modules\applications\widgets;

use yii\base\Widget;

class AppActiveMenuWidget extends Widget 
{
    public $app_id;

    public function run()
    {
        return $this->render('app_active', ['app_id' => $this->app_id]);
    }

}

