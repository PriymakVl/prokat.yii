<?php

namespace app\modules\objects\widgets;

use Yii;
use yii\base\Widget;

class ObjectFormTopMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('menu/form_top_menu');
    }

}

