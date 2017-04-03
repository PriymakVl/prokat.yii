<?php

namespace app\widgets;

use yii\base\Widget;

class SectionMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('menu/section');
    }

}

