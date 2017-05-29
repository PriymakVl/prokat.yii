<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;

class AppListMenuWidget extends Widget 
{
    public $state;
    
    public function run()
    {
        return $this->render('app_list', ['state' => $this->state]);
    }

}

